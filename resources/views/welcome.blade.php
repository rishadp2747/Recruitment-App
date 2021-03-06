<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="theme-color" content="#2874A6" />
  <link rel="icon" type="image/png" href="img/asap.png"/>

  <title>Welcome</title>

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
                  <div class="text-center">
                    <p class="p text-gray-900 mb-4">Navigate to the respective option.</p>
                  </div>
                  <hr>
                    @auth
                    <div class="text-center">
                    <a  class="btn btn-primary btn-block btn-lg" href="{{ route('home') }}">
                      <span class="icon text-white-50">
                        <i class="fas fa-home"></i>
                      </span>
                      <span class="text"> Dashboard</span>
                    </a>
                    </div>
                    <br>
                    @else
                      @if (Route::has('login'))
                      <div class="text-center">
                      <a  class="btn btn-success btn-block btn-lg" href="{{ route('login') }}">
                        <span class="icon text-white-50">
                          <i class="fas fa-sign-in-alt"></i>
                        </span>
                        <span class="text"> Login</span>
                      </a>
                      </div>
                      <br>
                      @endif
                       @if (Route::has('register'))
                      <div class="text-center">
                    <a type="submit" name="btn2" class="btn btn-danger btn-block btn-lg" href="{{ route('register') }}">
                        <span class="icon text-white-50">
                          <i class="fas fa-user-plus"></i>
                        </span>
                        <span class="text"> Register</span>
                      </a>
                     </div>
                     <br>
                     @endif
                   @endif
                 <div class="text-center">
                   <p>2020-21 &reg; All Rights Reserved.</p>
                 </div>
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
      setInterval(load_it, 1000);
  });
  function load_it(){
      const loader = document.querySelector(".loader");
      loader.className += " hidden"; // class "loader hidden"
  }
  </script>