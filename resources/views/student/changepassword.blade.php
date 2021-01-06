 @extends('layouts.student')

@section('content')
@if (\Session::has('errorinfo'))
                   <div class="alert alert-danger">
                       {!! \Session::get('errorinfo') !!}
                    </div>
                @endif
            @if (\Session::has('successinfo'))
                   <div class="alert alert-success">
                       {!! \Session::get('successinfo') !!}
                    </div>
                @endif
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
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2"><i class="fas fa-key"></i> <b>Reset Password</b></h1>
                    <p class="mb-4">Now you may change your password, by typing in your old and new password.</p>
                  </div>
                  <form class="user" method="POST" action="{{ route('changepasswordtodb') }}">
                    @csrf
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Old Password" name="current_password" required autocomplete="current-password">
                      @error('current_password')
                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="New Password" name="new_password" required autocomplete="current-password">
                    @error('new_password')
                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password-confirm" placeholder="Repeat Password" name="new_confirm_password" required autocomplete="current-password">
                  </div>
                  @error('new_confirm_password')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  @endsection