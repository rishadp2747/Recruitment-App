@extends('layouts.company')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-user-circle"></i> <b>Profile</b></h1>
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
            <form class="user" method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row justify-content-center">
              <img class="rounded-circle border-grey" width="120" height="120" src="@if(isset($data->Photo)){{ url('storage/uploads/company/photo/'.$data->Photo) }} @else{{ url('/img/default.png') }}@endif" id="photoview" onclick="clickPhotoUp()">
                <input type="file" name="photo" id="photo" >
                @error('photo')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Name" name="name" value="@if(old('name')!== null){{ old('name') }}@elseif(isset($uname)){{ $uname }}@else{{ '' }}@endif" required>
                @error('name')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="tel" class="form-control form-control-user" placeholder="Phone Number" name="phoneno" value="@if(old('phoneno')!== null){{ old('phoneno') }}@elseif(isset($data->Phoneno)){{ $data->Phoneno }}@else{{ '' }}@endif" required>
                @error('phoneno')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Address" name="address" required>@if(old('address')!== null){{ old('address') }}@elseif(isset($data->Address)){{ $data->Address }}@else{{ '' }}@endif</textarea>
                @error('address')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Description" name="description" required>@if(old('description')!== null){{ old('description') }}@elseif(isset($data->Description)){{ $data->Description }}@else{{ '' }}@endif</textarea>
                @error('description')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <input type="hidden" name="photoval" value="@if(isset($data->Photo)){{ $data->Photo }}@endif" >
              <button type="submit" class="btn btn-primary btn-user btn-block">
                <i class="fas fa-pencil-alt"></i> <b>Update Details</b>
              </button>
            </form>
            @if (isset($data->updated_at))
            <hr>
            <div class="text-center">
              <p>Your profile is <b class="green">completed</b> and it was last updated on <b class="red">{{ $data->updated_at }}</b></p>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    var photoview = document.getElementById('photoview');
    var photo = document.getElementById('photo');
    var cv = document.getElementById('cv');
    function clickPhotoUp(){
      photo.click();
    }
    document.getElementById("photo").addEventListener("change", function(e) {
  
    photoview.src = e.target.files[0];
    photoview.src = URL.createObjectURL(e.target.files[0]);
  
  });
  </script>
@endsection