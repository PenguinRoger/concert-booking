<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\CusUser;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Concert;
use PDF;

class BookingController extends Controller
{
    // แสดงหน้าจองตั๋ว
    public function showBookingForm($concert_id) {
        $concert = Concert::with('tickets')->where('id', $concert_id)->first();
        return view('Concert.ConcertAll', ['concert' => $concert]);
    }
    public function getTicketsForConcert($concert_id) {
        $tickets = Ticket::where('concert_id', $concert_id)->get();
        return response()->json($tickets);
    }

    // ประมวลผลการจอง
    public function processBooking(Request $request) {
        $user_id = $request->input('user_id');
        $concert_id = $request->input('concert_id');
        $ticket_type = $request->input('ticket_type');
        $ticket_quantity = $request->input('ticket_quantity');

        // เรียกข้อมูลคอนเสิร์ตจากฐานข้อมูล
        $concert = Concert::find($concert_id);

        // ตรวจสอบว่ามีคอนเสิร์ตนี้จริงๆหรือไม่
        if (!$concert) {
            return back()->with('error', 'Concert not found.');
        }

        // ตรวจสอบจำนวนตั๋วที่มีอยู่ในขณะนี้
        $ticket = Ticket::where('concert_id', $concert_id)
            ->where('type', $ticket_type)
            ->first();

        if (!$ticket) {
            return back()->with('error', 'Ticket not found.');
        }

        if ($ticket->quantity_available < $ticket_quantity) {
            return back()->with('error', 'Not enough tickets available.');
        }

            // สร้างการจอง
            $booking = new Booking();
            $booking->cus_user_id = $user_id;
            $booking->concert_id = $concert_id;
            $booking->ticket_id = $ticket->id;
            $booking->quantity = $ticket_quantity;
            $booking->total_price = $ticket->price * $ticket_quantity;
            $booking->save();

            if (Session::has('bookingDetails')) {
                Session::forget('bookingDetails');
            }
            // หลังจากการจองสำเร็จ
            $bookingDetails = [
                'name' => $request->name,
                'concert_name' => $concert->name,
                'ticket_type' => $request->ticket_type,
                'ticket_price' => $ticket->price,
                'ticket_quantity' => $ticket_quantity,
                'total_price' => $ticket->price * $ticket_quantity,
            ];

            // เก็บข้อมูลการจองใน Session
            Session::put('bookingDetails', $bookingDetails);

            // ลดจำนวนตั๋วในคลัง
            $ticket->quantity_available -= $ticket_quantity;
            $ticket->save();
            $request->session()->flash('success', 'จองสำเร็จ');
            return redirect('/ConcertBruTicket/allconcert')->with('success', 'Booking successful!');
    }

    public function showBookingDetails()
{
    // เรียกข้อมูลการจองจาก Session
    $booking = Session::get('bookingDetails');

    // ส่งข้อมูลไปยัง view
    return view('showBookingDetails', compact('booking'));
}

public function printTickets($customerId) {
    $bookings = Booking::where('cus_user_id', $customerId)->get();
    return view('pdf.booking', compact('bookings'));
}



}

