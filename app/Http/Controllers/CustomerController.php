<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\CusUser;
use App\Models\Booking;

class CustomerController extends Controller
{
    public function generatePDF()
    {
        $customers = CusUser::all();
        $pdf = PDF::loadView('pdf.customerinfo', compact('customers'));
        return $pdf->download('customers.pdf');
    }

    public function cusgeneratePDF($bookingId)
    {
        $booking = Booking::with(['user', 'concert', 'ticket'])->find($bookingId);

        if (!$booking) {
            abort(404);
        }

        $pdf = PDF::loadView('pdf.booking', ['booking' => $booking]);
        return $pdf->download('booking_details.pdf');
    }
}
