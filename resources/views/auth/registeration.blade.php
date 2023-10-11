<!doctype html>
<html lang="en">
  <head>
  	<title>สมัครสมาชิก</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(/images/concertwallpaper.jpg);">

        <form action="{{route('register-user')}}"method="POST" enctype="multipart/form-data">

            @csrf

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">สมัครสมาชิก</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">

		      		<div class="form-group">
		      			<input type="text" name="name" class="form-control" placeholder="full name" required
                            value="{{old('name')}}">
                        <span class="text-danger">
                            @error('name')
                                {{$message}}
                            @enderror
                        </span>
		      		</div>



                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" required
                            value="{{old('email')}}">
                        <span class="text-danger">
                            @error('email')
                                {{$message}}
                            @enderror
                        </span>
                    </div>



                    <div class="form-group">
                        <input type="text" name="phonnumber" class="form-control" placeholder="Phon Number" required
                            value="{{old('phonnumber')}}">
                    <span class="text-danger">
                        @error('phonnumber')
                            {{$message}}
                        @enderror
                    </span>
                    </div>


	            <div class="form-group">
	              <input id="password-field" type="password"  name="password" class="form-control" placeholder="Password" required
                  value="{{old('password')}}" >
                  <span class="text-danger">
                    @error('password')
                        {{$message}}
                    @enderror
                </span>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>


	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Registration</button>
	            </div>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

