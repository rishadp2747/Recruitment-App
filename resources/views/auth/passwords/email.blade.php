<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="theme-color" content="#2874A6" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="<?php echo URL::asset('img/asap.png'); ?>"/>

  <title>Password Recovery</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo URL::asset('vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo URL::asset('css/sb-admin-2.css'); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<!-- Loader -->
<div class="loader">
  <img src="<?php echo URL::asset('img/asap_portal.png'); ?>" width="200" height="40">
  <img src="<?php echo URL::asset('img/white.jpg'); ?>" width="80" height="80">
  <img src="<?php echo URL::asset('img/806.gif'); ?>" style="width: 80px; height: 80px;" alt="Loading...">
</div>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="row justify-content-center">
                    <img src="<?php echo URL::asset('img/asap_portal.png'); ?>" width="200" height="80">
                 </div>
                 <hr>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2"><i class="fas fa-key"></i> <b>Password Recovery</b></h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form class="user" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Send Password Reset Link
                    </button>
                  </form>
                  <hr>
                  @if (Route::has('register'))
                  <div class="text-center">
                  <a class="small" href="{{ route('register') }}"><b>Create an Account !</b></a>
                  </div>
                  @endif
                  @if (Route::has('login'))
                  <div class="text-center">
                    <a class="small" href="{{ route('login') }}"><b>Already have an account ? Login !</b></a>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo URL::asset('vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="<?php echo URL::asset('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo URL::asset('js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>
<script type="text/javascript">
  window.addEventListener("load", function () {
    setTimeout(load_it, 1000);
  });
  function load_it(){
      const loader = document.querySelector(".loader");
      loader.className += " hidden"; // class "loader hidden"
  }
  </script>