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
    <link rel="stylesheet" href="{{asset('css\MasterThem.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- เพิ่มภาพและแบบอักษรตามที่คุณต้องการ -->

</head>
<body>

    <!---ส่วนของ NavBar--->
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
                        <a class="dropdown-item" href="/logout-cus">Logout</a>
                    </div>
                </li>
            @else
                <li><a href="/Loginuser" ><i class='bx bx-log-in-circle'>Login</i></a></li>
            @endif

                </li>
            </ul>
        </div>


    <!----ส่วนหลัก---->
    <section class="section-highlight">
        <div class="inner">
            <div class="row">
                <div class="box-herobanner">
                    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images\SamSmith-ticket.jpg" class="d-block w-100 mx-auto" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images\TaylorSwitf-ticket.png" class="d-block w-100 mx-auto" alt="...">
                            </div>
                        </div>
                        <<a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




<!--สคริปเลื่อนไฮไล-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
