@php
    use Illuminate\Support\Facades\Session;
    use App\Models\CusUser;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองตั๋วคอนเสิร์ต</title>
    <link rel="stylesheet" href="{{ asset('css\MasterThemConTicketforticket.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- เพิ่มภาพและแบบอักษรตามที่คุณต้องการ -->

</head>

<body>
    <div class="banner">
        <div class="navbar">
            <a href="/ConcertBruTicket" class="logo">
                <i class='bx bxl-deezer'>Concert Ticket</i>
            </a>
            <ul class="navbar-menu">
                <li><a href="/ConcertBruTicket"><i class='bx bx-home-alt-2'>Home</i></a></li>
                <li><a href="/ConcertBruTicket/allconcert"><i class='bx bx-music'>Concert</i></a></li>
                <li><a href="/ConcertBruTicket/tricket"><i class='bx bx-message-square-dots'>Tickets</i></a></li>
                @if (Session::has('customerLoginId'))
                    <?php
                    $user = CusUser::where('id', '=', Session::get('customerLoginId'))->first();
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-user'></i> {{ $user->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarUserDropdown">
                            <!-- เปลี่ยนไปใช้ $user->id แทน $customerId -->
                            <a class="dropdown-item" href="/logout-cus">Logout</a>
                        </div>
                    </li>
                @else
                    <li><a href="/Loginuser"><i class='bx bx-log-in-circle'>Login</i></a></li>
                @endif
                </li>
            </ul>
        </div><!-- Pagination -->
        <div class="card-container">
            @foreach ($bookings as $booking)
                <div class="concert-card">
                    <div class="concert-image">
                        <img src="{{ asset('images/' . $booking->concert->image) }}"
                            alt="{{ $booking->concert->name }}">
                    </div>
                    <h2>{{ $booking->concert->name }}</h2>
                    <p>{{ $booking->concert->date_time }}</p>
                    <p>{{ $booking->concert->location }}</p>
                    <p>จำนวนตั๋วที่จอง: {{ $booking->quantity }}</p>
                    <p>ราคารวม: {{ $booking->total_price }}</p>
                    <!-- เพิ่มลิงก์หรือปุ่มสำหรับการพิมพ์ตั๋ว -->
                    <a href="{{ route('printTickets', ['bookingId' => $booking->id]) }}" class="btn btn-primary">Print
                        Ticket</a>

                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!! $bookings->links() !!}
        </div>



        <script src="{{ asset('js\ConcertAllJS.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
