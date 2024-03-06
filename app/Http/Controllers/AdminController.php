<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Concert;
use App\Models\CusUser;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Crypt;

class AdminController extends Controller
{
    public function Dashcon(){
        // return view('Dashbord.AdminDashbord-Concert');
    $concerts = Concert::all();
        return view('Dashbord.AdminDashbord-Concert', compact('concerts'));
    }

    public function storeConcert(Request $request) {
        $concert = new Concert;

        $concert->name = $request->input('name');
        $concert->description = $request->input('description');
        $concert->date_time = $request->input('date_time');
        $concert->location = $request->input('location');
        // ถ้ามีการอัพโหลดรูปภาพ
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            $concert->image = $filename;
        }

        $concert->save();

        return redirect()->back()->with('success', 'Concert added successfully');
    }

    public function Dashcus(){
        $cus_users = CusUser::all();
        return view('Dashbord.AdminDashbord-Customer', compact('cus_users'));
    }
    // เพิ่มลูกค้า
    public function addCustomer(Request $request) {
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
                return redirect('/AdminDashbord/customer')->with('success', 'Successfully added customer!');
                }else{
                    return redirect()->back()->with('error', 'Something wrong');
                }
        }
    // การแก้ไขข้อมูลลูกค้า
    public function updateCustomer(Request $request) {
        $customer = CusUser::find($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        // อัปเดตฟิลด์อื่น ๆ ที่ต้องการ
        $customer->save();

        return redirect('/AdminDashbord/customer')->with('success', 'แก้ไขลูกค้าสำเร็จ');
    }

    public function deleteCustomer(Request $request) {
        $customer = CusUser::find($request->id);
        $customer->delete();

        return redirect('/AdminDashbord/customer')->with('success', 'ลบลูกค้าสำเร็จ');
    }


    public function DashTicket(){
        $concerts = Concert::with('tickets')->get();
        foreach ($concerts as $concert) {
            $totalTicketsAvailable = $concert->tickets->sum('quantity_avaliable');

            $concert->total_tickets_available = $totalTicketsAvailable;
        }
        return view('Dashbord.AdminDashbord-Ticket', compact('concerts'));
    }



    // In AdminController.php

public function addTicket(Request $request) {
    $ticket = new Ticket;
    $ticket->concert_id = $request->input('concert_id');
    $ticket->type = $request->input('type');
    $ticket->price = $request->input('price');
    $ticket->quantity_avaliable = $request->input('quantity_avaliable');
    $ticket->save();

    return redirect()->back()->with('success', 'Ticket added successfully');
}


public function updateTicket(Request $request, $id) {
    $ticket = Ticket::find($id);
    $ticket->type = $request->input('type');
    $ticket->price = $request->input('price');
    $ticket->quantity_avaliable = $request->input('quantity_avaliable');
    $ticket->save();

    return redirect()->back()->with('success', 'Ticket updated successfully.');
}



public function deleteTicket($id) {
    $ticket = Ticket::find($id);
    if (!$ticket) {
        return redirect()->back()->with('error', 'Ticket not found.');
    }

    $ticket->delete();

    return redirect()->back()->with('success', 'Ticket deleted successfully');
}
public function editadd($id, Request $request) {

    $ticket = Ticket::find($id);

    if (!$ticket) {

        return redirect()->back()->with('error', 'Ticket not found.');

    }

    $ticket->quantity_avaliable = $request->input('quantity_avaliable');

    $ticket->save();

    return redirect()->back()->with('success', 'Ticket updated successfully');

}




}
