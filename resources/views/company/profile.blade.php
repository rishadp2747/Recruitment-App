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
                @if($status=='no')
                <p>*Please note that profile updation is only allowed once, so please cross check the data before submitting.</p>
                <p>*While uploading the photo please keep in mind that the allowed photo types are jpg and png. Maximum allowed upload size is 1MB.</p>
                <a class="btn btn-danger btn-user btn-block cnsnt" href="#"><i class="fas fa-eye"></i> I have read the above sentence</a>
                @endif
            <form class="user u_form  @if($status=='no') {{ 'hidden' }} @endif" method="POST" action="{{ route('profiles') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row justify-content-center">
              <img class="rounded-circle border-grey" width="120" height="120" src="@if(isset($data->Photo)){{ url('storage/uploads/company/photo/'.$data->Photo) }} @else{{ url('/img/default.png') }}@endif" id="photoview" onclick="clickPhotoUp()">
                <input @if($status=='yes'){{ 'disabled' }}@endif type="file" name="photo" id="photo" >
                @error('photo')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="mx-1" for="name" style="color:#161616;"><b>Company Name</b><span style="color:red"> *</span></label>
                <input @if($status=='yes'){{ 'disabled' }}@endif type="text" class="form-control form-control-user" placeholder="Name" name="name" value="@if(old('name')!== null){{ old('name') }}@elseif(isset($uname)){{ $uname }}@else{{ '' }}@endif" required>
                @error('name')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                  <label class="mx-1" for="phoneno" style="color:#161616;"><b>Phone Number</b><span style="color:red"> *</span></label>
                <input @if($status=='yes'){{ 'disabled' }}@endif type="tel" class="form-control form-control-user" placeholder="Phone Number" name="phoneno" value="@if(old('phoneno')!== null){{ old('phoneno') }}@elseif(isset($data->Phoneno)){{ $data->Phoneno }}@else{{ '' }}@endif" required>
                @error('phoneno')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
                </div>
              </div>
              <div class="form-group">
                <label class="mx-1" for="address" style="color:#161616;"><b>Company Address</b></label>
                <textarea @if($status=='yes'){{ 'disabled' }}@endif class="form-control form-control-user" placeholder="Address" name="address">@if(old('address')!== null){{ old('address') }}@elseif(isset($data->Address)){{ $data->Address }}@else{{ '' }}@endif</textarea>
                @error('address')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group">
                <label class="mx-1" for="url" style="color:#161616;"><b>Company URL</b></label>
                <input @if($status=='yes'){{ 'disabled' }}@endif type="text" class="form-control form-control-user" placeholder="url" name="url" value="@if(old('url')!== null){{ old('url') }}@elseif(isset($data->URL)){{ $data->URL }}@else{{ '' }}@endif">
                @error('description')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <input type="hidden" name="photoval" value="@if(isset($data->Photo)){{ $data->Photo }}@endif" >
              <button @if($status=='yes'){{ 'disabled' }}@endif type="submit" class="btn btn-primary btn-user btn-block">
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
  var u_form = document.querySelector(".u_form");
  var consent = document.querySelector(".cnsnt");
  consent.addEventListener("click",function(){
    u_form.classList.remove("hidden");
    consent.classList.add("hidden");
  });
  </script>
@endsection