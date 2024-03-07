<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\AdminDashbordStyle-ticket.css') }}">


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
            <li><a href="/AdminDashbord/concert"><i class='bx bx-music'></i>Concert</a></li>
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
                                Ticket
                            </a></li>
                        /
                        <li><a href="#" class="active">Manage Ticket</a></li>
                    </ul>
                </div>
            </div>

            <!-- Insights -->
            <!-- Scrollable modal -->
            <div class="row">
                @foreach ($concerts as $concert)
                    <!-- ในแบบฟอร์มของแต่ละการ์ด -->
                    <div class="col-md-3">
                        <div class="card mb-4 ">
                            <!-- เพิ่ม data-toggle และ data-target เพื่อเรียกใช้โมดอล -->
                            <img class="concert-image" src="{{ asset('images/' . $concert->image) }}"
                                alt="{{ $concert->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $concert->name }}</h5>
                                <p>Tickets Available: {{ $concert->total_tickets_available }}</p>
                                <a data-toggle="modal" data-target="#manageTicketModal{{ $concert->id }}"
                                    class="btn btn-primary">Manage Tickets</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="manageTicketModal{{ $concert->id }}" tabindex="-1"
                        aria-labelledby="manageTicketModalLabel{{ $concert->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="manageTicketModalLabel{{ $concert->id }}">Tickets for
                                        {{ $concert->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ประเภทตั๋ว</th>
                                                <th>ราคา</th>
                                                <th>จำนวนตั๋วที่มี</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($concert->tickets as $ticket)
                                                <tr>
                                                    <td>{{ $ticket->type }}</td>
                                                    <td>{{ $ticket->price }}</td>
                                                    <td>{{ $ticket->quantity_avaliable }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#editadd-ticket{{ $ticket->id }}">Edit
                                                            Ticket</button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#delete-ticket{{ $ticket->id }}">Delete</button>
                                                        <!-- Modal แก้ไขตั๋ว (Edit Ticket Modal) -->
                                                        <div class="modal fade" id="edit-ticket{{ $ticket->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="edit-ticketLabel{{ $ticket->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="edit-ticketLabel{{ $ticket->id }}">
                                                                            แก้ไขตั๋วสำหรับ {{ $concert->name }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="/update-ticket/{id}"
                                                                            method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="_method"
                                                                                value="PATCH">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="type">ประเภทตั๋ว:</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="type"
                                                                                    value="{{ $ticket->type }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="price">ราคา:</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    name="price"
                                                                                    value="{{ $ticket->price }}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="quantity_avaliable">จำนวนตั๋วที่มี:</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    name="quantity_avaliable"
                                                                                    value="{{ $ticket->quantity_avaliable }}"
                                                                                    required>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">บันทึก</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">ปิด</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal ลบตั๋ว (Delete Ticket Modal) -->
                                                        <div class="modal fade" id="delete-ticket{{ $ticket->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="delete-ticketLabel{{ $ticket->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="delete-ticketLabel{{ $ticket->id }}">
                                                                            ยืนยันการลบตั๋ว</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        คุณแน่ใจที่จะลบตั๋วประเภท {{ $ticket->type }}
                                                                        ของคอนเสิร์ต {{ $concert->name }} ใช่หรือไม่?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="/delete-ticket/{{ $ticket->id }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="_method"
                                                                                value="DELETE">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">ลบ</button>
                                                                        </form>
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">ปิด</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade"
                                                            id="editadd-ticket{{ $ticket->id }}" tabindex="-1"
                                                            aria-labelledby="editadd-ticketLabel{{ $ticket->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="editadd-ticketLabel{{ $ticket->id }}">
                                                                            กรอกจำนวนตั๋ว</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="/editadd-ticket/{{ $ticket->id }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="_method"
                                                                                value="post">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="quantity_avaliable">จำนวนตั๋วที่มี:</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    name="quantity_avaliable"
                                                                                    value="{{ $ticket->quantity_avaliable }}"
                                                                                    required>
                                                                            </div>

                                                                            <button type="submit"
                                                                                class="btn btn-primary">เพิ่ม</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">ปิด</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#addticket{{ $concert->id }}"> เพิ่มตั๋ว</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="addticket{{ $concert->id }}" data-backdrop="static"
                                        data-keyboard="false" tabindex="-1"
                                        aria-labelledby="addticket{{ $concert->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addticket">เพิ่มตั๋วสำหรับ
                                                        {{ $concert->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/add-ticket" method="post">
                                                        @csrf
                                                        <input type="hidden" name="concert_id"
                                                            value="{{ $concert->id }}">

                                                        <div class="form-group">
                                                            <label for="type">ประเภทตั๋ว:</label>
                                                            <input type="text" class="form-control" name="type"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">ราคา:</label>
                                                            <input type="number" class="form-control" name="price"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="quantity_avalilable">จำนวนตั๋วที่มี:</label>
                                                            <input type="number" class="form-control"
                                                                name="quantity_avaliable" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">ปิด</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <!-- JavaScript for Ticket Modals -->


    <script src="{{ asset('js\AdminDashbord.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
