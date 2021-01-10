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

  <title>Verify Your Email Address</title>

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
                    <h1 class="h4 text-gray-900 mb-2"><i class="fas fa-envelope-open-text"></i> <b>Verify Email</b></h1>
                    <p class="mb-4">Before proceeding, please check your email for a verification link.</p>
                  </div>
                  <hr>
                  <div class="text-center">
                    <p class="mb-4">If you did not received the email, click on the below button.</p>
                  </div>
                  @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your registered email address.') }}
                        </div>
                  @endif
                  <form class="user" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-user btn-block"><b>Resend Email</b></button>
                  </form>
                  <hr>
                  @auth
                  <div class="text-center">
                  <a class="medium" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="cursor:pointer;color:#0000CD;"><strong>Log Out</strong></a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                  </form>
                  </div>
                  @endauth
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