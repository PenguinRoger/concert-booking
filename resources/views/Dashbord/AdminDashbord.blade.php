<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\AdminDashbordStyle.css') }}">


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
            <li><a href="#"><i class='bx bx-book-open'></i>Tickets</a></li>
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


            <!-- End of Insights -->




                <!-- End of Reminders-->

            </div>

        </main>

    </div>

    <script src="{{ asset('js\AdminDashbord.js') }}"></script>

</body>

</html>
