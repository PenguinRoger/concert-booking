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
            $totalTicketsAvailable = $concert->tickets->sum('quantity_available');

            $concert->total_tickets_available = $totalTicketsAvailable;
        }
        return view('Concert.ConcertAll', ['concerts' => $concerts]);
    }

    public function concertall(){
        return view('Concert.ConcertAll');
    }



}
