<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



    <link rel="stylesheet" href="{{ asset('css\AdminDashbordStyle.css') }}">
    <title>Admin Dashboard</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="/AdminDashbord" class="logo">
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
                                Customer
                            </a></li>
                        /
                        <li><a href="#" class="active">Manage Customer</a></li>
                    </ul>
                </div>
                <a href="{{ url('/generate-pdf') }}" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download PDF</span>
                </a>
            </div>

            <!-- Insights -->

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">เพิ่มลูกค้า</button>

            <!-- Modal เพิ่มลูกค้า -->
            <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCustomerModalLabel">เพิ่มลูกค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- ตัวอย่างฟอร์มเพิ่มลูกค้า -->
                            <form action="{{url('/add-customer')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="customerName">ชื่อลูกค้า</label>
                                    <input type="text" name="name" class="form-control" placeholder="กรอกชื่อลูกค้า" required value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="customerEmail">อีเมลล์</label>
                                    <input type="email" name="email" class="form-control" placeholder="กรอกอีเมลล์" required value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label for="customerPhonNumber">เบอร์โทรลูกค้า</label>
                                    <input type="text" name="phonnumber" class="form-control" placeholder="กรอกเบอร์โทร" required value="{{old('phonnumber')}}">
                                </div>
                                <div class="form-group">
                                    <label for="customerPassword">รหัสผ่าน</label>
                                    <input id="password-field" type="password"  name="password" class="form-control" placeholder="กรอกรหัสผ่าน" required value="{{old('password')}}" >
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <!-- ต้องการเพิ่มเติมข้อมูลอื่นๆ ที่นี่ -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal แก้ไขลูกค้า -->
            <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCustomerModalLabel">แก้ไขลูกค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/edit-customer')}}" method="post" id="editCustomerForm">
                                @csrf
                                <!-- คุณต้องใช้ input hidden สำหรับ ID ของลูกค้า -->
                                <input type="hidden" id="customerId" name="id">
                                <div class="form-group">
                                    <label for="editCustomerName">ชื่อลูกค้า</label>
                                    <input type="text" name="name" class="form-control" id="editCustomerName" placeholder="กรอกชื่อลูกค้า">
                                </div>
                                <div class="form-group">
                                    <label for="editCustomerEmail">อีเมลล์</label>
                                    <input type="email" name="email" class="form-control" id="editCustomerEmail" placeholder="กรอกอีเมลล์">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal ยืนยันการลบลูกค้า -->
            <div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCustomerModalLabel">ยืนยันการลบลูกค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            คุณแน่ใจหรือไม่ว่าต้องการลบลูกค้านี้?
                            <form action="{{url('/delete-customer')}}"  method="post" id="deleteCustomerForm">
                                @csrf
                                <input type="hidden" id="deleteCustomerId" name="id">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-danger">ลบลูกค้า</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- ส่วนแสดงข้อมูลลูกค้า -->
            <div class="customer-list">
                <h2>Customer List</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cus_users as $cus_user)
                        <tr>
                            <td>{{ $cus_user->id }}</td>
                            <td>{{ $cus_user->name }}</td>
                            <td>{{ $cus_user->email }}</td>
                            <td>{{ $cus_user->phonnumber }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editCustomerModal" onclick="editCustomer({{ $cus_user->id }}, '{{ $cus_user->name }}', '{{ $cus_user->email }}')">แก้ไขข้อมูล</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCustomerModal" onclick="deleteCustomer({{ $cus_user->id }})">ลบ</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- End of Insights -->



                <!-- Reminders -->


                <!-- End of Reminders-->

            </div>

        </main>

    </div>
    <script>
        function openAddCustomerModal() {
            $('#addCustomerModal').modal('show');
        }

        function editCustomer(id, name, email) {
            $('#editCustomerModal').modal('show');
            // ตั้งค่าข้อมูลในฟอร์มแก้ไขลูกค้า
            $('#customerId').val(id);
            $('#editCustomerName').val(name);
            $('#editCustomerEmail').val(email);
            // เพิ่มการตั้งค่าฟิลด์อื่นๆ ตามต้องการ
        }

        function deleteCustomer(id) {
            $('#deleteCustomerId').val(id);
            $('#deleteCustomerModal').modal('show');
        }
    </script>
    <script src="{{ asset('js\AdminDashbord.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>
