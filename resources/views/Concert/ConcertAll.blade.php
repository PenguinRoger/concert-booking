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
    <link rel="stylesheet" href="{{asset('css\MasterThemConTicket.css')}}">
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
                <li><a href="/ConcertBruTicket"><i class='bx bx-home-alt-2' >Home</i></a></li>
                <li><a href="/ConcertBruTicket/allconcert"><i class='bx bx-music' >Concert</i></a></li>
                <li><a href="/ConcertBruTicket/tricket"><i class='bx bx-message-square-dots'>Tickets</i></a></li>
                    @if(Session::has('customerLoginId'))
                        <?php
                            $user = CusUser::where('id', '=', Session::get('customerLoginId'))->first();
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='bx bx-user'></i> {{$user->name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarUserDropdown">
                                <a class="dropdown-item" href="/print-tickets/{customerId}">Print Ticket</a>
                                <a class="dropdown-item" href="/logout-cus">Logout</a>
                            </div>
                        </li>
                    @else
                        <li><a href="/Loginuser"><i class='bx bx-log-in-circle'>Login</i></a></li>
                    @endif
                </li>
            </ul>
        </div>

        <div class="card-container">
            @foreach($concerts as $concert)
            <div class="concert-card">
                <div class="concert-image">
                    <img src="{{ asset('images/' . $concert->image) }}" alt="{{ $concert->name }}">
                </div>
                <h2>{{ $concert->name }}</h2>
                <p>{{ $concert->date_time }}</p>
                <p>{{ $concert->location }}</p>
                <p>จำนวนตั๋วที่เหลือ: {{ $concert->total_tickets_available }}</p>
                @if($concert->total_tickets_available > 0)
                    <!-- ปุ่ม "Buy Ticket" -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookingModal-{{ $concert->id }}">
                        จองตั๋ว
                    </button>
                @else
                    <p class="text-danger">ตั๋วหมด</p>
                @endif
            </div>

        <div class="modal fade" id="bookingModal-{{ $concert->id }}" tabindex="-1" aria-labelledby="bookingModalLabel-{{ $concert->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel">Book Your Ticket for {{ $concert->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body-booking-ticket">
                            <form action="{{ route('processBooking', ['concert_id' => $concert->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="concert_id" value="{{ $concert->id }}">
                                <input type="hidden" name="user_id" value="{{ Session::get('customerLoginId') }}">

                                <div class="form-group">
                                    <label for="name">ชื่อผู้จอง:</label>
                                    @if(Session::has('customerLoginId'))
                                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" readonly>
                                    @else
                                        <!-- This input field should not appear if the user is not logged in, but just in case -->
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="ticket_type">ประเภทตั๋ว:</label>
                                    <select class="form-control" id="ticket_type" name="ticket_type" onchange="showTicketPrice(this)">
                                        @foreach($concert->tickets as $ticket)
                                            @if($ticket->quantity_avaliable > 0)
                                                <option value="{{ $ticket->type }}" data-price="{{ $ticket->price }}" data-remaining-tickets="{{ $ticket->quantity_avaliable }}">
                                                    {{ $ticket->type }} ({{ $ticket->price }} บาท) - จำนวนที่เหลือ: {{ $ticket->quantity_avaliable }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ticket_price">ราคาตั๋ว:</label>
                                    <span id="ticket_price" class="form-control" readonly></span>
                                </div>

                                <div class="form-group">
                                    <label for="ticket_quantity">จำนวนตั๋วที่ต้องการจอง:</label>
                                    <input type="number" class="form-control" id="ticket_quantity" name="ticket_quantity" required>
                                </div>

                                <div class="form-group">
                                    <label for="total_price">ราคารวม:</label>
                                    <span id="total_price" class="form-control" readonly></span>
                                </div>

                                <!-- Since the booking time will be automatically determined by the system, we no longer need an input field for it -->

                                <button type="submit" class="btn btn-primary">ยืนยันการจอง</button>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js\ConcertAllJS.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function showTicketPrice(element) {
            const selectedOption = element.options[element.selectedIndex];
            const price = selectedOption.getAttribute("data-price");
            const ticketType = selectedOption.value;
            const remainingTickets = selectedOption.getAttribute("data-remaining-tickets");

            // Check if remaining tickets is 0, disable selection and show alert
            if (parseInt(remainingTickets) === 0) {
                alert("ขออภัย ตั๋วประเภทนี้หมดแล้ว");
                element.selectedIndex = -1; // Clear selection
                document.getElementById("ticket_quantity").setAttribute("disabled", "disabled");
            } else {
                document.getElementById("ticket_quantity").removeAttribute("disabled");
            }

            document.getElementById("ticket_price").textContent = price;
            document.getElementById("ticket_quantity").setAttribute("max", remainingTickets);
            updateTotalPrice();
        }

        function updateTotalPrice() {
            const ticketPrice = parseFloat(document.getElementById("ticket_price").textContent);
            const ticketQuantity = parseInt(document.getElementById("ticket_quantity").value);
            const totalPrice = ticketPrice * ticketQuantity;
            document.getElementById("total_price").textContent = totalPrice.toFixed(2);
        }


            document.getElementById("ticket_quantity").addEventListener("input", updateTotalPrice);

            function openBookingModal(concertId) {
                $('#bookingModal-' + concertId).modal('show');
        }
    </script>
</body>
</html>
