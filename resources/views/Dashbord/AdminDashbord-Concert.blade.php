<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\AdminDashbordStyle-concert.css') }}">


    <title>Admin Dashboard</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxl-deezer'></i>
            <div class="logo-name"><span>Admin</span>Music</div>
        </a>

        <ul class="side-menu">
            <li><a href="/AdminDashbord/concert"><i class='bx bx-music' ></i>Concert</a></li>
            <li><a href="/AdminDashbord/ticket"><i class='bx bx-book-open'></i>Tickets</a></li>
            <li><a href="/AdminDashbord/customer"><i class='bx bx-user'></i>Customer</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('logout') }}" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
        </nav>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Concert
                            </a></li>
                        /
                        <li><a href="#" class="active">Manage Concert</a></li>
                    </ul>
                </div>
            </div>

            <!-- Insights -->
            <!-- Scrollable modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addConcertModal">เพิ่มคอนเสิร์ต</button>

            <div class="modal fade" id="addConcertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">เพิ่มคอนเสิร์ต</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('/add-concert') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="name">ชื่อคอนเสิร์ต</label>
                          <input type="text" name="name" class="form-control" placeholder="ชื่อคอนเสิร์ต" required>
                        </div>
                        <div class="form-group">
                          <label for="description">รายละเอียดคอนเสิร์ต</label>
                          <textarea name="description" class="form-control" placeholder="รายละเอียดคอนเสิร์ต" required></textarea>
                        </div>
                        <div class="form-group">
                          <label for="image">รูปภาพ</label>
                          <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="date_time">วันและเวลา</label>
                          <input type="datetime-local" name="date_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="location">สถานที่</label>
                          <input type="text" name="location" class="form-control" placeholder="สถานที่" required>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                          <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                @foreach($concerts as $concert)
                    <!-- ในแบบฟอร์มของแต่ละการ์ด -->
                    <div class="col-md-3">
                        <div class="card mb-4 ">
                            <!-- เพิ่ม data-toggle และ data-target เพื่อเรียกใช้โมดอล -->
                            <a href="#concertModal{{ $concert->id }}" data-toggle="modal" data-target="#concertModal{{ $concert->id }}">
                                <img class="concert-image" src="{{ asset('images/' . $concert->image) }}" alt="{{ $concert->name }}">
                                <div class="card-body">
                                    <h5 class="card-title ">{{ $concert->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- โมดอลของแต่ละการ์ด -->
                    <div class="modal fade" id="concertModal{{ $concert->id }}" tabindex="-1" aria-labelledby="concertModal{{ $concert->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="concertModal{{ $concert->id }}Label">{{ $concert->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- ใช้รูปแบบ CSS ใหม่ -->
                                    <img class="concert-image" src="{{ asset('images/' . $concert->image) }}" alt="{{ $concert->name }}">
                                    <p>{{ $concert->description }}</p>
                                    <p>Date & Time: {{ $concert->date_time }}</p>
                                    <p>Location: {{ $concert->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>



                @endforeach
            </div>




            <!-- End of Insights -->



                <!-- Reminders -->


                <!-- End of Reminders-->

            </div>

        </main>

    </div>


    <!--ส่วนของสคริป--->
    <script src="{{ asset('js\AdminDashbord.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
