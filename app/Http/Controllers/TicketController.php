<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function getTicketsForConcert($concert_id) {
        $tickets = Ticket::where('concert_id', $concert_id)->get();
        return response()->json($tickets);
    }
}
