<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
</head>
<body>
    @if($bookings->count() > 0)
        @foreach($bookings as $booking)
        <h1>ข้อมูลการจอง</h1>
        <p>ชื่อ: {{ $booking->name }}</p>
        <p>คอนเสิร์ต: {{ $booking->concert_name }}</p>
        <p>ประเภทตั๋ว: {{ $booking->ticket_type }}</p>
        <p>ราคาตั๋ว: {{ $booking->ticket_price }}</p>
        <p>จำนวนตั๋ว: {{ $booking->ticket_quantity }}</p>
        <p>ราคาสุทธิ: {{ $booking->total_price }}</p>
        @endforeach
    @else
        <p>ไม่พบข้อมูลการจอง</p>
    @endif

    <script>
        window.print(); // Auto-trigger print dialog
    </script>
</body>
</html>
