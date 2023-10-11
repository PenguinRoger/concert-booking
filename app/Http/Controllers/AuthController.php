<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CusUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Crypt;



class AuthController extends Controller {


    //<---หน้าเข้าระบบ--->
    public function login() {
        return view('auth.AdminLogin');
    }
    public function userlogin() {
        return view('auth.login');
    }

    public function loginCus(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:12'
        ]);
        $user = CusUser::where('email', '=', $request->email)->first();
        if($user){
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('customerLoginId', $user->id);
                    $request->session()->put('username', $user->name);
                    return redirect('/ConcertBruTicket');
                } else {
                    return back()->with('fail', 'Password not matches.');
                }
            } else {
                return back()->with('fail', 'This email is not registered.');
            }

        }

    }

    public function loginUser(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:12'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if($user){
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('AdminDashbord');
                } else {
                    return back()->with('fail', 'Password not matches.');
                }
            } else {
                return back()->with('fail', 'This email is not registered.');
            }

        }

    }


    // <---หน้าสมัคร--->
    public function registration() {
        return view('auth.registeration');
    }

    public function registerUser(Request $request) {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:12',
            'phonnumber'=>'required']);

            $user = new CusUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phonnumber = $request->phonnumber;
            $res = $user->save();
            if($res){
                return redirect('/Loginuser')->with('success', 'Successfully registered!');
                }else{
                return back()->with('fail','Something wrong'); }
        }

        //<---หน้าเข้าส่วนจัดการแอดมิน--->
    public function dashbord() {
        if(Session::has('loginId')){
             $data = User::where('id', '=', Session::get('loginId')) ->first();
        }
        return view('Dashbord.AdminDashbord', compact('data'));
    }


        //<---กดออกจากระบบ--->
    public function logout() {
        if(Session::has('loginId')){
        Session::pull('loginId');
        return redirect('Login');
        }
    }

    public function logoutCus() {
        if(Session::has('customerLoginId')){
            Session::pull('customerLoginId');
            Session::pull('username');  // ถ้ามี session อื่น ๆ ของลูกค้า
            return redirect('/ConcertBruTicket');
        }
    }


}
