<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="<?php echo URL::asset('img/fav1.png'); ?>"/>

  <title>Company Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo URL::asset('vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo URL::asset('css/sb-admin-2.css'); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

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
                <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-building"></i>  <b>Company Register</b></h1>
              </div>
              @if (\Session::has('info'))
                     <div class="alert alert-danger">
                         {!! \Session::get('info') !!}
                      </div>
              @endif
            <form class="user" method="POST" action="{{ route('comp_reg') }}">
              @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name" placeholder="Company Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="new-password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password-confirm" placeholder="Repeat Password" name="password_confirmation" required autocomplete="new-password">
                  </div>
                  @error('password')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <button type="submit" class="btn btn-danger btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
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

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo URL::asset('vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="<?php echo URL::asset('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo URL::asset('js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>
