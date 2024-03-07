<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\AdminLogin.css') }}">
    <title>Admin Login</title>
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <form action="{{ route('login-user') }}" method="POST"enctype="multipart/form-data">
                                <div class="mb-md-5 mt-md-4 pb-5">

                                    @if (Session::has('success'))
                                        <div class="alert alert-success"> {{ Session::get('success') }}</div>
                                    @endif

                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger"> {{ Session::get('fail') }}</div>
                                    @endif
                                    @csrf

                                    <h2 class="fw-bold mb-2 text-uppercase">Admin Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" name="email"
                                            class="form-control form-control-lg" placeholder="Enter email" />
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" name="password"
                                            class="form-control form-control-lg" placeholder="Enter password" />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
