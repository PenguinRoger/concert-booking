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
class ConcertController extends Controller
{
    public function index() {
        // return view('ConcertBruTicket', compact('concerts'));
        return view('Concert.ConcertMainform');
    }

    public function allConcerts() {
        $concerts = Concert::all();
        $concerts = Concert::with('tickets')->get();
        foreach ($concerts as $concert) {
            $totalTicketsAvailable = $concert->tickets->sum('quantity_avaliable');

            $concert->total_tickets_available = $totalTicketsAvailable;
        }
        return view('Concert.ConcertAll', ['concerts' => $concerts]);
    }

    public function deleteConcert(Request $request){
        $concert = Concert::find($request->concert_id);
        if ($concert) {
            $concert->delete();
            return redirect()->back()->with('success', 'ลบข้อมูลคอนเสริตเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลคอนเสริต');
        }
    }

    public function concertall(){
        return view('Concert.ConcertAll');
    }



}
