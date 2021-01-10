@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-user-plus"></i> <b>Add Student</b></h1>
            </div>
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
            <form class="user" method="POST" action="{{ route('studentadds') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required>
                @error('email')
                   <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
              </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Add Student
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection