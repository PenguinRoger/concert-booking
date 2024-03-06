<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <link rel="stylesheet" href="{{ asset('css/BookingDetail.css') }}">
</head>
<body>
    <div class="container">
        <h1>ข้อมูลการจอง</h1>
        <p>ชื่อ: {{ $booking->cus_user->name }}</p>
        <p>คอนเสิร์ต: {{ $booking->concert->name }}</p>
        <p>วันที่จอง: {{ $booking->concert->date_time }}</p>
        <p>สถานที่: {{ $booking->concert->location }}</p>
        <p>ประเภทตั๋ว: {{ $booking->ticket->type }}</p>
        <p>ราคาตั๋ว: {{ $booking->ticket->price }}</p>
        <p>จำนวนตั๋ว: {{ $booking->quantity }}</p>
        <p>ราคาสุทธิ: {{ $booking->total_price }}</p>
    </div>

    <script>
        window.print(); // Auto-trigger print dialog
    </script>
</body>
</html>
