@extends('layouts.student')

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
              <img class="rounded-circle border-grey" width="120" height="120" src="@if(isset($data->Photo)){{ url('storage/uploads/student/photo/'.$data->Photo) }} @else{{ url('/img/default.png') }}@endif" id="photoview" onclick="clickPhotoUp()">
                <input type="file" name="photo" id="photo" >
                @error('photo')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Name" name="name" value="@if(old('name')!== null){{ old('name') }}@elseif(isset($uname)){{ $uname }}@else{{ '' }}@endif">
                @error('name')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="number" class="form-control form-control-user" placeholder="Age" name="age" value="@if(old('age')!== null){{ old('age') }}@elseif(isset($data->Age)){{ $data->Age }}@else{{ '' }}@endif">
                  @error('age')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Address" name="address">@if(old('address')!== null){{ old('address') }}@elseif(isset($data->Address)){{ $data->Address }}@else{{ '' }}@endif</textarea>
                @error('address')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Qualifications" name="qualifications">@if(old('qualifications')!== null){{ old('qualifications') }}@elseif(isset($data->Qualifications)){{ $data->Qualifications }}@else{{ '' }}@endif</textarea>
                @error('qualifications')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Skills" name="skills">@if(old('skills')!== null){{ old('skills') }}@elseif(isset($data->Skills)){{ $data->Skills }}@else{{ '' }}@endif</textarea>
                @error('skills')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group">
                  <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" id="exampleInputPassword" placeholder="Date of Birth" name="dob" value="@if(old('dob')!== null){{ old('dob') }}@elseif(isset($data->DOB)){{ $data->DOB }}@else{{ '' }}@endif">
                  @error('dob')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group">
                <input type="tel" class="form-control form-control-user" placeholder="Phone Number" name="phoneno" value="@if(old('phoneno')!== null){{ old('phoneno') }}@elseif(isset($data->Phoneno)){{ $data->Phoneno }}@else{{ '' }}@endif">
                @error('phoneno')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
              <div class="form-group row justify-content-center">
                <div class="col-sm-6">
                  <div class="row justify-content-center">
                    <button type="button" class="btn btn-danger btn-user btn-block" onclick="clickcv()"><i class="fas fa-upload"></i> <b>Upload CV</b></button>
                </div>
                <input type="file" name="cv" id="cv" onChange='getoutput()'>
                <input type="hidden" name="photoval" value="@if(isset($data->Photo)){{ $data->Photo }}@endif" > 
                <input type="hidden" name="cvval" value="@if(isset($data->CV)){{ $data->CV }}@endif" > 
                @error('cv')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="row justify-content-center">
                  <label>CV Upload status => @if(isset($data->CV))<b class="green">Already Uploaded</b>@else<b class="red">Not Uploaded</b>@endif</label>
                </div>
                @if(isset($data->CV))
                <div class="row justify-content-center">
                  <label>To download your uploaded CV <a href="{{ url('storage/uploads/student/cv/'.$data->CV) }}" class="btn btn-success btn-user btn-block"><b>click here</b></a></label>
                </div>
                @endif
                </div>
                <div class="col-sm-6">
                  <div class="row justify-content-center">
                  <label id="fileout">No file chosen to update your CV</label>
                </div>
                </div>
              </div>
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
    function clickcv(){
        cv.click();
    }
    function getFile(filePath) {
          return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
      }
    function getoutput() {
      console.log('in');
          var output = document.getElementById('fileout');
          var file = document.getElementById('cv');
          var name = getFile(file.value);
          var ext = file.value.split('.')[1];
          if(name!==''){
            var name1 = '<b><span class="red">Selected </span></b> <b>=><b> <b class="black">'+name+'.'+ext+'</b> (CV) for upoad';
           }
          else{
            var name1 = ''; 
           }
          //extension.value = inputfile.value.split('.')[1];
          output.innerHTML = name1;
      }
  </script><script type="text/javascript">
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
  function clickcv(){
      cv.click();
  }
  function getFile(filePath) {
        return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
    }
  function getoutput() {
    console.log('in');
        var output = document.getElementById('fileout');
        var file = document.getElementById('cv');
        var name = getFile(file.value);
        var ext = file.value.split('.')[1];
        if(name!==''){
          var name1 = '<b><span class="red">Selected </span></b> <b>=><b> <b class="black">'+name+'.'+ext+'</b> (CV) for upoad';
         }
        else{
          var name1 = 'No file chosen to update your CV'; 
         }
        //extension.value = inputfile.value.split('.')[1];
        output.innerHTML = name1;
    }
</script>
@endsection