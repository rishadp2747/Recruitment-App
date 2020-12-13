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
                <textarea class="form-control form-control-user" placeholder="Bio" name="bio">@if(old('bio')!== null){{ old('bio') }}@elseif(isset($data->Bio)){{ $data->Bio }}@else{{ '' }}@endif</textarea>
                @error('bio')
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
                <textarea class="form-control form-control-user" placeholder="Volunteership" name="volunteership">@if(old('volunteership')!== null){{ old('volunteership') }}@elseif(isset($data->Volunteership)){{ $data->Volunteership }}@else{{ '' }}@endif</textarea>
                @error('volunteership')
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
            <hr>

            <div class="acad0">
            <div class="form-group">
                <p class="op p-2">Academic details 1</p>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Course" name="course0" value="@if(old('course0')!== null){{ old('course0') }}@elseif(isset($data->Course0)){{ $data->Course0 }}@else{{ '' }}@endif">
                  @error('course0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" placeholder="CGPA/Percentage" name="cgpa0" value="@if(old('cgpa0')!== null){{ old('cgpa0') }}@elseif(isset($data->CGPA0)){{ $data->CGPA0 }}@else{{ '' }}@endif">
                  @error('cgpa0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Board/University" name="board0" value="@if(old('board0')!== null){{ old('board0') }}@elseif(isset($data->Board0)){{ $data->Board0 }}@else{{ '' }}@endif">
                @error('board0')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Institution/School" name="institution0" value="@if(old('institution0')!== null){{ old('institution0') }}@elseif(isset($data->Institution0)){{ $data->Institution0 }}@else{{ '' }}@endif">
                @error('institution0')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join0" value="@if(old('join0')!== null){{ old('join0') }}@elseif(isset($data->Join0)){{ $data->Join0 }}@else{{ '' }}@endif">
                  @error('join0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass0" value="@if(old('pass0')!== null){{ old('pass0') }}@elseif(isset($data->Pass0)){{ $data->Pass0 }}@else{{ '' }}@endif">
                  @error('pass0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
             </div>

             <div class="acad1 hidden">
            <div class="form-group">
                <p class="op p-2">Academic details 2</p>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Course" name="course1" value="@if(old('course1')!== null){{ old('course1') }}@elseif(isset($data->Course1)){{ $data->Course1 }}@else{{ '' }}@endif">
                  @error('course1')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" placeholder="CGPA/Percentage" name="cgpa1" value="@if(old('cgpa1')!== null){{ old('cgpa1') }}@elseif(isset($data->CGPA1)){{ $data->CGPA1 }}@else{{ '' }}@endif">
                  @error('cgpa1')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Board/University" name="board1" value="@if(old('board1')!== null){{ old('board1') }}@elseif(isset($data->Board1)){{ $data->Board1 }}@else{{ '' }}@endif">
                @error('board1')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Institution/School" name="institution1" value="@if(old('institution1')!== null){{ old('institution1') }}@elseif(isset($data->Institution1)){{ $data->Institution1 }}@else{{ '' }}@endif">
                @error('institution1')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join1" value="@if(old('join1')!== null){{ old('join1') }}@elseif(isset($data->Join1)){{ $data->Join1 }}@else{{ '' }}@endif">
                  @error('join1')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass1" value="@if(old('pass1')!== null){{ old('pass1') }}@elseif(isset($data->Pass1)){{ $data->Pass1 }}@else{{ '' }}@endif">
                  @error('pass1')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group row justify-content-center">
              <div class="col-6">
              <button onclick="removefield(1)" type="button" class="btn btn-danger btn-user btn-block">
                <i class="fas fa-trash-alt"></i> <b>Delete this field</b>
              </button>
              </div>
              </div>
             </div>

             <div class="acad2 hidden">
            <div class="form-group">
                <p class="op p-2">Academic details 3</p>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Course" name="course2" value="@if(old('course2')!== null){{ old('course2') }}@elseif(isset($data->Course2)){{ $data->Course2 }}@else{{ '' }}@endif">
                  @error('course2')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" placeholder="CGPA/Percentage" name="cgpa2" value="@if(old('cgpa2')!== null){{ old('cgpa2') }}@elseif(isset($data->CGPA2)){{ $data->CGPA2 }}@else{{ '' }}@endif">
                  @error('cgpa2')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Board/University" name="board2" value="@if(old('board2')!== null){{ old('board2') }}@elseif(isset($data->Board2)){{ $data->Board2 }}@else{{ '' }}@endif">
                @error('board2')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Institution/School" name="institution2" value="@if(old('institution2')!== null){{ old('institution2') }}@elseif(isset($data->Institution2)){{ $data->Institution2 }}@else{{ '' }}@endif">
                @error('institution2')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join2" value="@if(old('join2')!== null){{ old('join2') }}@elseif(isset($data->Join2)){{ $data->Join2 }}@else{{ '' }}@endif">
                  @error('join2')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass2" value="@if(old('pass2')!== null){{ old('pass2') }}@elseif(isset($data->Pass2)){{ $data->Pass2 }}@else{{ '' }}@endif">
                  @error('pass2')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group row justify-content-center">
              <div class="col-6">
              <button onclick="removefield(2)" type="button" class="btn btn-danger btn-user btn-block">
                <i class="fas fa-trash-alt"></i> <b>Delete this field</b>
              </button>
              </div>
              </div>
             </div>

             <div class="acad3 hidden">
            <div class="form-group">
                <p class="op p-2">Academic details 4</p>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Course" name="course3" value="@if(old('course3')!== null){{ old('course3') }}@elseif(isset($data->Course3)){{ $data->Course3 }}@else{{ '' }}@endif">
                  @error('course3')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" placeholder="CGPA/Percentage" name="cgpa3" value="@if(old('cgpa3')!== null){{ old('cgpa3') }}@elseif(isset($data->CGPA3)){{ $data->CGPA3 }}@else{{ '' }}@endif">
                  @error('cgpa3')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Board/University" name="board3" value="@if(old('board3')!== null){{ old('board3') }}@elseif(isset($data->Board3)){{ $data->Board3 }}@else{{ '' }}@endif">
                @error('board3')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Institution/School" name="institution3" value="@if(old('institution3')!== null){{ old('institution3') }}@elseif(isset($data->Institution3)){{ $data->Institution3 }}@else{{ '' }}@endif">
                @error('institution3')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join3" value="@if(old('join3')!== null){{ old('join3') }}@elseif(isset($data->Join3)){{ $data->Join3 }}@else{{ '' }}@endif">
                  @error('join3')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass3" value="@if(old('pass3')!== null){{ old('pass3') }}@elseif(isset($data->Pass3)){{ $data->Pass3 }}@else{{ '' }}@endif">
                  @error('pass3')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group row justify-content-center">
              <div class="col-6">
              <button onclick="removefield(3)" type="button" class="btn btn-danger btn-user btn-block">
                <i class="fas fa-trash-alt"></i> <b>Delete this field</b>
              </button>
              </div>
              </div>
             </div>

             <div class="acad4 hidden">
            <div class="form-group">
                <p class="op p-2">Academic details 5</p>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Course" name="course4" value="@if(old('course4')!== null){{ old('course4') }}@elseif(isset($data->Course4)){{ $data->Course4 }}@else{{ '' }}@endif">
                  @error('course4')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" placeholder="CGPA/Percentage" name="cgpa4" value="@if(old('cgpa4')!== null){{ old('cgpa4') }}@elseif(isset($data->CGPA4)){{ $data->CGPA4 }}@else{{ '' }}@endif">
                  @error('cgpa4')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Board/University" name="board4" value="@if(old('board4')!== null){{ old('board4') }}@elseif(isset($data->Board4)){{ $data->Board4 }}@else{{ '' }}@endif">
                @error('board4')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" placeholder="Institution/School" name="institution1" value="@if(old('institution4')!== null){{ old('institution4') }}@elseif(isset($data->Institution4)){{ $data->Institution4 }}@else{{ '' }}@endif">
                @error('institution4')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join4" value="@if(old('join4')!== null){{ old('join4') }}@elseif(isset($data->Join4)){{ $data->Join4 }}@else{{ '' }}@endif">
                  @error('join4')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass4" value="@if(old('pass4')!== null){{ old('pass4') }}@elseif(isset($data->Pass4)){{ $data->Pass4 }}@else{{ '' }}@endif">
                  @error('pass4')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group row justify-content-center">
              <div class="col-6">
              <button onclick="removefield(4)" type="button" class="btn btn-danger btn-user btn-block">
                <i class="fas fa-trash-alt"></i> <b>Delete this field</b>
              </button>
              </div>
              </div>
             </div>

              <div class="form-group row">
              <button onclick="addfield()" type="button" class="btn btn-primary btn-user btn-block adf">
                <i class="fas fa-plus"></i> <b>Add new field</b>
              </button>
              </div>
              <hr>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="number" class="form-control form-control-user" placeholder="History of backlogs" name="backlogs" value="@if(old('backlogs')!== null){{ old('backlogs') }}@elseif(isset($data->Backlogs)){{ $data->Backlogs }}@else{{ '' }}@endif">
                  @error('backlogs')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <input type="number" class="form-control form-control-user" placeholder="Current backlogs" name="current_backlogs" value="@if(old('current_backlogs')!== null){{ old('current_backlogs') }}@elseif(isset($data->Current_Backlogs)){{ $data->Current_Backlogs }}@else{{ '' }}@endif">
                  @error('current_backlogs')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>

            <div class="form-group">
                <input type="url" class="form-control form-control-user" placeholder="Linkedin URL" name="linkedin" value="@if(old('linkedin')!== null){{ old('linkedin') }}@elseif(isset($data->Linkedin)){{ $data->Linkedin }}@else{{ '' }}@endif">
                @error('linkedin')
                <p class="p-2 red-alert" role="alert">{{ $message }}</p>
               @enderror
            </div>
            <div class="form-group">
                <input type="url" class="form-control form-control-user" placeholder="Github URL" name="github" value="@if(old('github')!== null){{ old('github') }}@elseif(isset($data->Github)){{ $data->Github }}@else{{ '' }}@endif">
                @error('github')
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
              <div class="form-group row justify-content-center">
                <div class="col-sm-6">
                  <div class="row justify-content-center">
                    <button type="button" class="btn btn-danger btn-user btn-block" onclick="clickcert()"><i class="fas fa-upload"></i> <b>Upload Certificates</b></button>
                </div>
                <input type="file" name="cert" id="cert" onChange='getoutputcert()'>
                <input type="hidden" name="certval" value="@if(isset($data->Certificates)){{ $data->Certificates }}@endif" > 
                @error('cv')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="row justify-content-center">
                  <label>Certificates Upload status => @if(isset($data->Certificates))<b class="green">Already Uploaded</b>@else<b class="red">Not Uploaded</b>@endif</label>
                </div>
                @if(isset($data->CV))
                <div class="row justify-content-center">
                  <label>To download your uploaded Certificates <a href="{{ url('storage/uploads/student/certificates/'.$data->Certificates) }}" class="btn btn-success btn-user btn-block"><b>click here</b></a></label>
                </div>
                @endif
                </div>
                <div class="col-sm-6">
                  <div class="row justify-content-center">
                  <label id="fileoutcert">No file chosen to update your Certificates</label>
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
  var cert = document.getElementById('cert');
  function clickPhotoUp(){
    photo.click();
  }
  document.getElementById("photo").addEventListener("change", function(e) {

  photoview.src = e.target.files[0];
  photoview.src = URL.createObjectURL(e.target.files[0]);

});
  function removefield(num) {
  	var ad = document.querySelector(".acad"+num);
  	ad.classList.add("hidden");
    document.querySelector(".adf").removeAttribute("hidden");
  }
  function addfield(){
      var ad_1 = document.querySelector(".acad1");
      var ad_2 = document.querySelector(".acad2");
      var ad_3 = document.querySelector(".acad3");
      var ad_4 = document.querySelector(".acad4");
      var adf = document.querySelector(".adf");
      if(ad_1.classList.contains("hidden")){
      	ad_1.classList.remove("hidden");
      }
      else if(ad_2.classList.contains("hidden")){
      	ad_2.classList.remove("hidden");
      }
      else if(ad_3.classList.contains("hidden")){
      	ad_3.classList.remove("hidden");
      }
      else if(ad_4.classList.contains("hidden")){
      	ad_4.classList.remove("hidden");
        adf.setAttribute("hidden", 'true');
      }
  }
  function clickcv(){
      cv.click();
  }
  function clickcert(){
      cert.click();
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
          var name1 = '<b><span class="red">Selected </span></b> <b>=><b> <b class="black">'+name+'.'+ext+'</b> (CV) for upload';
         }
        else{
          var name1 = 'No file chosen to update your CV'; 
         }
        //extension.value = inputfile.value.split('.')[1];
        output.innerHTML = name1;
    }
    function getoutputcert() {
    console.log('in');
        var output1 = document.getElementById('fileoutcert');
        var file1 = document.getElementById('cert');
        var name4 = getFile(file1.value);
        var ext2 = file1.value.split('.')[1];
        if(name4!==''){
          var name2 = '<b><span class="red">Selected </span></b> <b>=><b> <b class="black">'+name4+'.'+ext2+'</b> (Certificates) for upload';
         }
        else{
          var name2 = 'No file chosen to update your Certificates'; 
         }
        //extension.value = inputfile.value.split('.')[1];
        output1.innerHTML = name2;
    }
</script>
@endsection