@extends('layouts.student')

@section('content')
@php
$qual_num = 0;
foreach($qualifications as $item){
$qual_num = $qual_num + 1;
}
@endphp
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
                <p>*While uploading the CV/certificate please keep in mind that the allowed CV/certificate type is pdf. Maximum allowed upload size is 2MB.</p>
                <p>*All certificates should be in a single pdf.</p>
                <p>*In the educational qualification section please try to fill the qualification in order ( eg :- If you are an under graduate then fill the qualification in this order => 10th, 12th and then Under Graduate).</p>
                <p>*If you encounter any technical fault in this form while filling, please refresh the form by <a class="btn btn-success btn-user" href=""><i class="fas fa-hand-point-up"></i> clicking here</a></p>
                <a class="btn btn-danger btn-user btn-block cnsnt" href="#"><i class="fas fa-eye"></i> I have read the above sentence</a>
                @endif
            <form class="user u_form  @if($status=='no') {{ 'hidden' }} @endif" method="POST" action="{{ route('profiles') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group row justify-content-center">
              <img @if($status=='yes'){{ 'disabled' }}@endif class="rounded-circle border-grey" width="120" height="120" src="@if(isset($data->Photo)){{ url('storage/uploads/student/photo/'.$data->Photo) }} @else{{ url('/img/default.png') }}@endif" id="photoview" onclick="clickPhotoUp()">
                <input @if($status=='yes'){{ 'disabled' }}@endif type="file" name="photo" id="photo" >
                @error('photo')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="name">Full Name <span style="color:red">*</span></label>
                <input type="text" class="form-control form-control-user" placeholder="Name" name="name" value="@if(old('name')!== null){{ old('name') }}@elseif(isset($uname)){{ $uname }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif required>
                @error('name')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <label for="qulatification">Age <span style="color:red">*</span></label>
                <input type="number" min="18" max="100" class="form-control form-control-user" placeholder="Age" name="age" value="@if(old('age')!== null){{ old('age') }}@elseif(isset($data->Age)){{ $data->Age }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif required>
                  @error('age')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                  <label for="gender">Address<span style="color:red">*</span></label>
                    <textarea class="form-control form-control-user" min="5" max="500" placeholder="Address" name="address" @if($status=='yes'){{ 'disabled' }}@endif required>@if(old('address')!== null){{ old('address') }}@elseif(isset($data->Address)){{ $data->Address }}@else{{ '' }}@endif</textarea>
                    @error('address')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>

                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                  <label for="gender">Give a short description about you.<span style="color:red">*</span></label>
                  <textarea min="5" max="200" class="form-control form-control-user" placeholder="Bio" name="bio" @if($status=='yes'){{ 'disabled' }}@endif required>@if(old('bio')!== null){{ old('bio') }}@elseif(isset($data->Bio)){{ $data->Bio }}@else{{ '' }}@endif</textarea>
                  @error('bio')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>

                </div>
              </div>
              
              

              <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="dob">Date of Birth<span style="color:red">*</span></label>
                      <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" id="exampleInputPassword" placeholder="Date of Birth" name="dob" value="@if(old('dob')!== null){{ old('dob') }}@elseif(isset($data->DOB)){{ $data->DOB }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif required>
                      @error('dob')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                     <label for="phoneno">Mobile Number<span style="color:red">*</span></label>
                      <input type="tel" class="form-control form-control-user" placeholder="Phone Number" name="phoneno" value="@if(old('phoneno')!== null){{ old('phoneno') }}@elseif(isset($data->Phoneno)){{ $data->Phoneno }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif required>
                      @error('phoneno')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                  <label for="gender">Gender<span style="color:red">*</span></label>
                    <select class="form-control " name="gender" id="gender" @if($status=='yes'){{ 'disabled' }}@endif required>
                      <option value="" @if(old('')) {{'selected'}} @endif>Select your gender</option>
                      <option value="male"  @if(old('male')) {{'selected'}} @endif>Male</option>
                      <option value="female"  @if(old('female')) {{'selected'}} @endif>Female</option>
                      <option value="other"  @if(old('other')) {{'selected'}} @endif>Other</option>
                    </select>
                      @error('gender')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                  </div>  
                </div>
              </div>

              
             

             
     
            <div class="form-group">
            <label for="exampleInputEmail1">Completed Asap Courses<span style="color:red">*</span></label>
            @if($status=='no')
              <div class="d-flex flex-wrap ">
                @foreach ($asap as $item)
                <div class="form-check m-3">
                  <input class="form-check-input" name="asapskills[]" type="checkbox" value="{{$item->course_name}}" id='asapcourses{{$item->id}}'>
                  <label class="form-check-label" for="defaultCheck1">
                      {{$item->course_name}}
                  </label>
                </div>
                @endforeach
              </div>
              @error('asapskills')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
              @else 
              <input type="text" class="form-control form-control-user" disabled value="@if(isset($data->Asap_Skills)){{$data->Asap_Skills}}@else{{ '' }}@endif">
              @endif
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Other Skills<span style="color:red">*</span></label>
                    <textarea rows="5" class="form-control form-control-user" placeholder="Skills" name="skills" @if($status=='yes'){{ 'disabled' }}@endif required>@if(old('skills')!== null){{ old('skills') }}@elseif(isset($data->Skills)){{ $data->Skills }}@else{{ '' }}@endif</textarea>
                    @error('skills')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>


                </div>

                <div class="col-sm-6">

                <div class="form-group">
                      <label class="form-check-label" for="defaultCheck1">Volunteership</label>
                    @if($status=='no')
                      <select name="volunteership[]" class="selectpicker w-50 m-3" multiple data-live-search="true">
                        @foreach ($volunteership_ss as $item)
                          <option value='{{$item->volunteerships}}' >{{$item->volunteerships}}</options>
                        @endforeach
                      </select>
                      @error('volunteership')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                    @else
                    <input type="text" class="form-control form-control-user" disabled value="@if(isset($data->Volunteership)){{$data->Volunteership}}@else{{ '' }}@endif">
                    @endif
                    </div>

                    <div class="form-group">
                      <label for="aadhaar">Aadhaar Number<span style="color:red">*</span></label>
                      <input type="number" class="form-control form-control-user" placeholder="Type your aadhaar number" name="aadhaar" value="@if(old('aadhaar')!== null){{ old('aadhaar') }}@elseif(isset($data->Aadhaar)){{ $data->Aadhaar }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif required>
                        @error('aadhaar')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                    </div>

              </div>

            </div>

            <div class="row">

                <div class="col-sm-6">
                    <div class="form-group">
                    <label class="form-check-label" for="defaultCheck1">Linkedin</label>
                    <input type="url" class="form-control form-control-user" placeholder="Linkedin URL" name="linkedin" value="@if(old('linkedin')!== null){{ old('linkedin') }}@elseif(isset($data->Linkedin)){{ $data->Linkedin }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                    @error('linkedin')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>


                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                  <label class="form-check-label" for="defaultCheck1">Git</label>
                      <input type="url" class="form-control form-control-user" placeholder="Git URL" name="github" value="@if(old('github')!== null){{ old('github') }}@elseif(isset($data->Github)){{ $data->Github }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                      @error('github')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>


                </div>

            
           

            </div>

            <hr>

            <div class="acad0">
            @if($status=='no')
            <div class="form-group">
                <p class="op p-2">Educational Details 1</p>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="qulatification">Qualification <span style="color:red">*</span></label>
                    <select class="form-control" name="qualification0" id="qualification0" onchange="qualChange(0)" required>
                    	<option value='' >Please select your option</options>
                        @foreach ($qualifications as $item)
                            <option value='{{$item->id}}' >{{$item->qualification}}</options>
                          @endforeach
                    </select>
                      @error('qualification1')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                  </div>
              </div> 
            </div>


            <div class="row">
            	<div class="col-sm-4">
                <div class="form-group" id="course0e">
                  <label for="qulatification">Course Name <span style="color:red">*</span></label>
                    <select class="form-control" name="course0" id="course0" onchange="otherField('course0',0); courseChange(0);" required>
                            <option value='' >Please select your option</options>
                    </select>
                    @error('course0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
             </div>
             <div class="col-sm-4">
                <div class="form-group" id="specialisation0e">
                  <label for="specialisation">Specialisation <span style="color:red">*</span></label>
                    <select class="form-control" name="specialisation0" id="specialisation0" onchange="otherField('specialisation0',0)" required>
                            <option value='' >Please select your option</options>
                    </select>
                    @error('specialisation0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
             </div>
              <div class="col-sm-4">
                <div class="form-group" id="board0e">
                  <label for="qulatification">Board/University <span style="color:red">*</span></label>
                    <select class="form-control" name="board0" id="board0" onchange="otherField('board0',0)" required>
                            <option value='' >Please select your option</options>
                    </select>
                    @error('board0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="qulatification">Institution Name<span style="color:red">*</span></label>
                    <input type="text" class="form-control form-control-user" placeholder="Institution Name" name="institution0" value="@if(old('institution0')!== null){{ old('institution0') }}@elseif(isset($data->Institution0)){{ $data->Institution0 }}@else{{ '' }}@endif" required>
                    @error('institution0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              </div>


            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="percentage">Percentage<span style="color:red">*</span> (Convert cgpa into percentage) </label>
                  <input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name="cgpa0" value="@if(old('cgpa0')!== null){{ old('cgpa0') }}@elseif(isset($data->CGPA0)){{ $data->CGPA0 }}@else{{ '' }}@endif" required>
                    @error('cgpa0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                <label for="join">Date of Joining<span style="color:red">*</span></label>
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join0" value="@if(old('join0')!== null){{ old('join0') }}@elseif(isset($data->Join0)){{ $data->Join0 }}@else{{ '' }}@endif" required>
                  @error('join0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror

                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                <label for="join">Date of Passing<span style="color:red">*</span></label>
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass0" value="@if(old('pass0')!== null){{ old('pass0') }}@elseif(isset($data->Pass0)){{ $data->Pass0 }}@else{{ '' }}@endif" required>
                  @error('pass0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
              <div class="col-sm-2">
                    <div class="form-group">
                    <label for="join">History of Backlogs<span style="color:red">*</span></label>
                    <input type="number" min="0" max="100" class="form-control form-control-user" placeholder="History of Backlogs" name="hback0" value="@if(old('hback0')!== null){{ old('hback0') }}@elseif(isset($data->Hback0)){{ $data->Hback0 }}@else{{ '' }}@endif" id="hback0" required>
                    @error('hback0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                    <label for="join">Current Backlogs<span style="color:red">*</span></label>
                    <input type="number" min="0" max="100" class="form-control form-control-user" placeholder="Current Backlogs" name="cback0" value="@if(old('cback0')!== null){{ old('cback0') }}@elseif(isset($data->Cback0)){{ $data->Cback0 }}@else{{ '' }}@endif" id="cback0" required>
                    @error('cback0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                    </div>
                  </div>
            </div>
          </div>

          <div class="row d-none" id="qual">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="qulatification">Qualification <span style="color:red">*</span></label>
                    <select class="form-control" name="qualification1" id="copyQual">
                        @foreach ($qualifications as $item)
                            <option value='{{$item->id}}' >{{$item->qualification}}</options>
                          @endforeach
                    </select>
                      @error('qualification1')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                  </div>
              </div> 
            </div>

        
          <div id="addQualification">
          </div>


          <div class="d-flex">
              <div class="form-group row">
                <div id="addQ" class="btn btn-primary btn-user btn-block adf">
                  <i class="fas fa-plus"></i> <b>Add Qualification</b>
                </div>
              </div>  
            </div>
         <hr>
         @else
         @php
          $ne = 1;
         @endphp
         @foreach($stud_qual as $it)
         <div class="form-group">
             <p class="op p-2">Educational Details {{ $ne }}</p>
         </div>
         @php
          $ne = $ne +1;
         @endphp
         <div class="row">
           
           <div class="col-sm-4">
             <div class="form-group">
               <label for="qulatification">Qualification</label>
                 <input type="text" class="form-control form-control-user" disabled value="@foreach($qualifications as $items)@if($items->id==$it->qualification){{ $items->qualification }}@endif @endforeach">
             </div>
           </div>

           <div class="col-sm-4">
              <div class="form-group">
                <label for="qulatification">Course</label>
                  <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->course)){{ $it->course }}@else{{ '' }}@endif">
              </div>
            </div>

           <div class="col-sm-4">
             <div class="form-group">
               <label for="qulatification">Specialisation</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->specialisation)){{ $it->specialisation }}@else{{ '' }}@endif">
             </div>
           </div>

         </div>

         <div class="row">
         	<div class="col-sm-6">
             <div class="form-group">
               <label for="qulatification">Board/University</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->board)){{ $it->board }}@else{{ '' }}@endif">
             </div>
           </div>
         	<div class="col-sm-6">
         	<div class="form-group">
               <label for="qulatification">Institution Name</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->institution)){{ $it->institution }}@else{{ '' }}@endif">
             </div>
         </div>
         </div>

         <div class="row">
           <div class="col-sm-4">
             <div class="form-group">
               <label for="qulatification">CGPA</label>
                 <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->cgpa)){{ $it->cgpa }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-sm-4">
             <div class="form-group">
               <label for="qulatification">History of Backlogs</label>
                 <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->hbacklogs)){{ $it->hbacklogs }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-sm-4">
             <div class="form-group">
               <label for="qulatification">Current Backlogs</label>
                 <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->cbacklogs)){{ $it->cbacklogs }}@else{{ '' }}@endif">
             </div>
           </div>
         </div>

         <div class="row">
           <div class="col-sm-6">
             <div class="form-group">
               <label for="qulatification">Date of joining</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->join)){{ $it->join }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-sm-6">
             <div class="form-group">
               <label for="qulatification">Date of passing</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->pass)){{ $it->pass }}@else{{ '' }}@endif">
             </div>
           </div>
          </div>
         <hr>
         @endforeach
         @endif



            <div class="row">

              <div class="col-sm-6">
              
              <div class="form-group row justify-content-center">
                <div class="col-sm-6">
                  <div class="row justify-content-center">
                    <button @if($status=='yes'){{ 'disabled' }}@endif type="button" class="btn btn-danger btn-user btn-block" onclick="clickcv()"><i class="fas fa-upload"></i> <b>Upload CV</b></button>
                </div>
                <input @if($status=='yes'){{ 'disabled' }}@endif type="file" name="cv" id="cv" onChange='getoutput()'>
                <input type="hidden" name="photoval" value="@if(isset($data->Photo)){{ $data->Photo }}@endif" > 
                <input type="hidden" name="cvval" value="@if(isset($data->CV)){{ $data->CV }}@endif" > 
                @error('cv')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div id="fileout" class="col-12"></div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <div class="row justify-content-center">
                  <label>CV Upload status => @if(isset($data->CV))<b class="green">Already Uploaded</b>@else<b class="red">Not Uploaded</b>@endif</label>
                </div>
                @if(isset($data->CV))
                <div class="row justify-content-center">
                  <label>To download your uploaded CV <a href="{{ url('storage/uploads/student/cv/'.$data->CV) }}" class="btn btn-success btn-user btn-block"><b>click here</b></a></label>
                </div>
                @endif
                </div>
              </div>
              
              </div>


              <div class="col-sm-6">

              <div class="form-group row justify-content-center">
                <div class="col-sm-6">
                  <div class="row justify-content-center">
                    <button @if($status=='yes'){{ 'disabled' }}@endif type="button" class="btn btn-danger btn-user btn-block" onclick="clickcert()"><i class="fas fa-upload"></i> <b>Upload Certificates</b></button>
                </div>
                <input @if($status=='yes'){{ 'disabled' }}@endif type="file" name="cert" id="cert" onChange='getoutputcert()'>
                <input type="hidden" name="certval" value="@if(isset($data->Certificates)){{ $data->Certificates }}@endif" > 
                @error('cv')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div id="fileoutcert" class="col-12"></div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <div class="row justify-content-center">
                  <label>Certificates Upload status => @if(isset($data->Certificates))<b class="green">Already Uploaded</b>@else<b class="red">Not Uploaded</b>@endif</label>
                </div>
                @if(isset($data->CV))
                <div class="row justify-content-center">
                  <label>To download your uploaded Certificates <a href="{{ url('storage/uploads/student/certificates/'.$data->Certificates) }}" class="btn btn-success btn-user btn-block"><b>click here</b></a></label>
                </div>
                @endif
                </div>
              </div>



              </div>

            </div>
 

          
            

            <hr>

            <div class="row">
              <div class="col-12">

              <input @if($status=='yes'){{ 'disabled checked' }}@endif class="form-check-input" type="checkbox" name="ok" id='asapcourses' required>
                  <label class="form-check-label" for="defaultCheck1">
                      I here by delcare that the above informations are correct to the best of my knowledge.
                  </label>

              </div>


            </div>
              <button @if($status=='yes'){{ 'disabled' }}@endif type="submit" class="btn btn-primary btn-user btn-block my-5">
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

var qual_num = @php echo $qual_num; @endphp;

$(document).ready(function() {
  var id = 1


  $("#addQ").click(function(){

    var qual = $("#qual").html();

    qSet = $('#copyQual');

    qSet.attr('name','qualification'+id);
    //alert(qSet.attr('name'));

 
    
    

    //alert(qual);

    var row1 = "<hr><div class='form-group'><p class='op p-2'>Educational Details "+(id+1)+"</p></div><div class='row'><div class='col-sm-4'><div class='form-group'><label for='qulatification'>Qualification <span style='color:red'>*</span></label><select class='form-control' name='qualification"+id+"' id='qualification"+id+"' onchange='qualChange("+id+")'><option value='' >Please select your option</options>"+qSet.html()+"</select></div></div></div>";
     
    var row2 =  '<div class="row">'+
                 '<div class="col-sm-4">'+
                  '<div class="form-group" id="course'+id+'e">'+
                   '<label for="qulatification">Course Name<span style="color:red">*</span></label>'+
                    "<select class='form-control' name='course"+id+"' id='course"+id+"' onchange='otherField("+'&#39;'+'course'+id+'&#39;'+","+id+"); courseChange("+id+");'><option value='' >Please select your option</options></select>"+
                '</div>'+
             '</div>'+

            '<div class="col-sm-4">'+
                '<div class="form-group" id="specialisation'+id+'e">'+
                  '<label for="qulatification">Specialisation<span style="color:red">*</span></label>'+
                    "<select class='form-control' name='specialisation"+id+"' id='specialisation"+id+"' onchange='otherField("+'&#39;'+'specialisation'+id+'&#39;'+","+id+")'><option value='' >Please select your option</options></select>"+
                '</div>'+
             '</div>'+

              '<div class="col-sm-4">'+
                '<div class="form-group" id="board'+id+'e">'+
                  '<label for="qulatification">Board/University<span style="color:red">*</span></label>'+
                   "<select class='form-control' name='board"+id+"' id='board"+id+"' onchange='otherField("+'&#39;'+'board'+id+'&#39;'+","+id+")'><option value='' >Please select your option</options></select>"+
                '</div>'+
              '</div>'+
              '</div>'

    var row3 = '<div class="row">'+
               
               '<div class="col-12">'+
                '<div class="form-group">'+
                 '<label for="qulatification">Institution Name<span style="color:red">*</span></label>'+
                   '<input type="text" class="form-control form-control-user" placeholder="Institution Name" name=institution'+id+' >'+
                '</div>'+
              '</div>'+

               '</div>'

    var row4 = '<div class="row">'+

                  '<div class="col-sm-4">'+
                    '<div class="form-group">'+
                      '<label for="percentage">Percentage<span style="color:red">*</span> (Convert cgpa into percentage) </label>'+
                      '<input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name=cgpa'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-sm-2">'+
                    '<div class="form-group">'+
                    '<label for="join">Date of Joining<span style="color:red">*</span></label>'+
                    '<input type="text" onfocus="(this.type=&#39;date&#39;)" class="form-control form-control-user" placeholder="Year of joining" name=join'+id+'>'+

                    '</div>'+
                  '</div>'+

                  '<div class="col-sm-2">'+
                    '<div class="form-group">'+
                    '<label for="join">Date of Passing<span style="color:red">*</span></label>'+
                    '<input type="text" onfocus="(this.type=&#39;date&#39;)" class="form-control form-control-user" placeholder="Year of passing" name=pass'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-sm-2">'+
                    '<div class="form-group">'+
                    '<label for="join">History of Backlogs<span style="color:red">*</span></label>'+
                    '<input type="number" min="0" max="100" class="form-control form-control-user" placeholder="History of Backlogs" name=hback'+id+' id=hback'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-sm-2">'+
                    '<div class="form-group">'+
                    '<label for="join">Current Backlogs<span style="color:red">*</span></label>'+
                    '<input type="number" min="0" max="100" class="form-control form-control-user" placeholder="Current Backlogs" name=cback'+id+' id=cback'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '</div>'
  


    $('#addQualification').append(row1);
    $('#addQualification').append(row2);
    $('#addQualification').append(row3);
    $('#addQualification').append(row4);

    id = id+1

    if(id==qual_num){
       $("#addQ").remove();
  	}

  });

});

function otherField(name,num){
   var n = name+'e';
   var n_c = 'course'+num;
   var n_s = 'specialisation'+num;
   var n_s_e = 'specialisation'+num+'e';
   var e = document.getElementById(name);
   var e_s = document.getElementById(n_s);
   var e_s_e = document.getElementById(n_s_e);
   var val = e.value;
   if(val=='others'){
      var el = document.getElementById(n);
      e.remove();
      var x = document.createElement("INPUT");
      x.setAttribute("type", "text");
      x.id = name;
      x.name = name;
      x.className = "form-control form-control-user";
      x.placeholder = "Type here";
      el.appendChild(x);
      if(n_c==name){
         e_s.remove();
         var x = document.createElement("INPUT");
         x.setAttribute("type", "text");
         x.id = n_s;
         x.name = n_s;
         x.className = "form-control form-control-user";
         x.placeholder = "Type here";
         e_s_e.appendChild(x);
      }
  }
}

 function qualChange(num){
 	var name = 'qualification'+num;
 	var name2 = 'course'+num;
 	var name3 = 'specialisation'+num;
 	var name4 = 'board'+num;
 	var name5 = 'hback'+num;
 	var name6 = 'cback'+num;
 	var name7 = 'board'+num+'e';
 	var e = document.getElementById(name);
 	var el = document.getElementById(name2);
 	var ele = document.getElementById(name3);
 	var elem = document.getElementById(name4);
 	var element = document.getElementById(name7);
 	var h = document.getElementById(name5);
 	var c = document.getElementById(name6);
 	var val = e.value;

 	if(val=='1'){
 		 el.innerHTML = '<option value="" >Please select your option</options>';
 		 ele.innerHTML = '<option value="" >Please select your option</options>';
 		 elem.innerHTML = '<option value="" >Please select your option</options>';
         var opt = document.createElement('option');
         opt.value = 'Not Applicable';
         opt.innerHTML = 'Not Applicable';
         opt.selected = true;
         el.appendChild(opt);

         var opt2 = document.createElement('option');
         opt2.value = 'Not Applicable';
         opt2.innerHTML = 'Not Applicable';
         opt2.selected = true;
         ele.appendChild(opt2);

         var opt3 = document.createElement('option');
         opt3.value = 'CBSE';
         opt3.innerHTML = 'CBSE';
         elem.appendChild(opt3);

         var opt4 = document.createElement('option');
         opt4.value = 'ICSE';
         opt4.innerHTML = 'ICSE';
         elem.appendChild(opt4);

         var opt5 = document.createElement('option');
         opt5.value = 'State Board';
         opt5.innerHTML = 'State Board';
         elem.appendChild(opt5);

         var opt6 = document.createElement('option');
         opt6.value = 'others';
         opt6.innerHTML = 'Others';
         elem.appendChild(opt6);

         h.value = 0;
         c.value = 0;
 	}
 	else if(val=='2'){
 		 el.innerHTML = '<option value="" >Please select your option</options>';
 		 ele.innerHTML = '<option value="" >Please select your option</options>';
 		 elem.innerHTML = '<option value="" >Please select your option</options>';
 		 var opt = document.createElement('option');
         opt.value = 'Science';
         opt.innerHTML = 'Science';
         el.appendChild(opt);

         var opt2 = document.createElement('option');
         opt2.value = 'Commerce';
         opt2.innerHTML = 'Commerce';
         el.appendChild(opt2);

         var opt22 = document.createElement('option');
         opt22.value = 'Humanities';
         opt22.innerHTML = 'Humanities';
         el.appendChild(opt22);

         var opt3 = document.createElement('option');
         opt3.value = 'CBSE';
         opt3.innerHTML = 'CBSE';
         elem.appendChild(opt3);

         var opt4 = document.createElement('option');
         opt4.value = 'ISC';
         opt4.innerHTML = 'ISC';
         elem.appendChild(opt4);

         var opt5 = document.createElement('option');
         opt5.value = 'State Board';
         opt5.innerHTML = 'State Board';
         elem.appendChild(opt5);

         var opt6 = document.createElement('option');
         opt6.value = 'others';
         opt6.innerHTML = 'Others';
         elem.appendChild(opt6);

         h.value = 0;
         c.value = 0;

 	}
 	else if(val=='3'){
 		 el.innerHTML = '<option value="" >Please select your option</options>';
 		 ele.innerHTML = '<option value="" >Please select your option</options>';
 		 elem.innerHTML = '<option value="" >Please select your option</options>';

 		 var opt = document.createElement('option');
         opt.value = 'B.Tech';
         opt.innerHTML = 'B.Tech';
         el.appendChild(opt);

         var opt2 = document.createElement('option');
         opt2.value = 'BSc';
         opt2.innerHTML = 'BSc';
         el.appendChild(opt2);

         var opt22 = document.createElement('option');
         opt22.value = 'BCA';
         opt22.innerHTML = 'BCA';
         el.appendChild(opt22);

         var opt3 = document.createElement('option');
         opt3.value = 'B.Com';
         opt3.innerHTML = 'B.Com';
         el.appendChild(opt3);

         var opt4 = document.createElement('option');
         opt4.value = 'BA';
         opt4.innerHTML = 'BA';
         el.appendChild(opt4);

         var opt5 = document.createElement('option');
         opt5.value = 'BBA';
         opt5.innerHTML = 'BBA';
         el.appendChild(opt5);

         var opt6 = document.createElement('option');
         opt6.value = 'others';
         opt6.innerHTML = 'Others';
         el.appendChild(opt6);

         elem.remove();
         var x = document.createElement("INPUT");
         x.setAttribute("type", "text");
         x.id = name4;
         x.name = name4;
         x.className = "form-control form-control-user";
         x.placeholder = "Type here";
         element.appendChild(x);
 	}
 	else if(val=='5' || val=='4'){
 		el.innerHTML = '<option value="" >Please select your option</options>';
 		 ele.innerHTML = '<option value="" >Please select your option</options>';
 		 elem.innerHTML = '<option value="" >Please select your option</options>';

 		 var opt = document.createElement('option');
         opt.value = 'Diploma';
         opt.innerHTML = 'Diploma';
         opt.selected = true;
         el.appendChild(opt);
         courseChange(num);

         elem.remove();
         var x = document.createElement("INPUT");
         x.setAttribute("type", "text");
         x.id = name4;
         x.name = name4;
         x.className = "form-control form-control-user";
         x.placeholder = "Type here";
         element.appendChild(x);

 	}
 }

 function courseChange(num){
 	var name = 'course'+num;
 	var name2 = 'specialisation'+num;
 	var name3 = 'specialisation'+num+'e';
 	var e = document.getElementById(name);
 	var el = document.getElementById(name2);
 	var ele = document.getElementById(name3);
 	var val = e.value;
 	if(val=='Science'){
 	  el.innerHTML = '<option value="" >Please select your option</options>';

 	     var opt = document.createElement('option');
         opt.value = 'Physics, Chemistry&Maths';
         opt.innerHTML = 'Physics, Chemistry & Maths';
         el.appendChild(opt);

         var opt2 = document.createElement('option');
         opt2.value = 'Physics, Chemistry, Maths & Computer Science';
         opt2.innerHTML = 'Physics, Chemistry, Maths & Computer Science';
         el.appendChild(opt2);

         var opt22 = document.createElement('option');
         opt22.value = 'Physics, Chemistry, Maths & Biology';
         opt22.innerHTML = 'Physics, Chemistry, Maths & Biology';
         el.appendChild(opt22);

         var opt3 = document.createElement('option');
         opt3.value = 'others';
         opt3.innerHTML = 'Others';
         el.appendChild(opt3);
 	}
 	else if(val=='Commerce'){
 	  el.innerHTML = '<option value="" >Please select your option</options><option value="others" selected>Not Applicable</options>';
 	}
 	else if(val=='Humanities'){
 	  el.innerHTML = '<option value="" >Please select your option</options><option value="others" selected>Not Applicable</options>';
 	}
 	else if(val=='B.Tech' || val=='Diploma'){
 	  el.innerHTML = '<option value="" >Please select your option</options>';

 	     var opt = document.createElement('option');
         opt.value = 'Computer Science and Engineering';
         opt.innerHTML = 'Computer Science and Engineering';
         el.appendChild(opt);

         var opt2 = document.createElement('option');
         opt2.value = 'Civil Engineering';
         opt2.innerHTML = 'Civil Engineering';
         el.appendChild(opt2);

         var opt22 = document.createElement('option');
         opt22.value = 'Electronic Engineering';
         opt22.innerHTML = 'Electronic Engineering';
         el.appendChild(opt22);

         var opt11 = document.createElement('option');
         opt11.value = 'Electrical Engineering';
         opt11.innerHTML = 'Electrical Engineering';
         el.appendChild(opt11);

         var opt33 = document.createElement('option');
         opt33.value = 'Mechanical Engineering';
         opt33.innerHTML = 'Mechanical Engineering';
         el.appendChild(opt33);

         var opt4 = document.createElement('option');
         opt4.value = 'Chemical Engineering';
         opt4.innerHTML = 'Chemical Engineering';
         el.appendChild(opt4);

         var opt3 = document.createElement('option');
         opt3.value = 'others';
         opt3.innerHTML = 'Others';
         el.appendChild(opt3);
 	}
 	else if(val=='BSc' || val=='BCA' || val=='B.Com' || val=='BA' || val=='BBA'){
 	     el.innerHTML = '<option value="" >Please select your option</options><option value="others">Others</options>';
 	}

 }


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
          var name1 = '<div class="row justify-content-center p-2"><b><span class="red">Selected </span></b> <b>=><b> <b class="black">'+name+'.'+ext+'</b> (CV) for upload</div>';
         }
        else{
          var name1 = '<div class="row justify-content-center p-2">No file chosen to update your CV</div>'; 
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
          var name2 = '<div class="row justify-content-center p-2"><b><span class="red">Selected </span></b> <b>=><b> <b class="black">'+name4+'.'+ext2+'</b> (Certificates) for upload</div>';
         }
        else{
          var name2 = '<div class="row justify-content-center p-2">No file chosen to update your Certificates</div>'; 
         }
        //extension.value = inputfile.value.split('.')[1];
        output1.innerHTML = name2;
    }

  var u_form = document.querySelector(".u_form");
  var consent = document.querySelector(".cnsnt");
  consent.addEventListener("click",function(){
    u_form.classList.remove("hidden");
    consent.style.display = 'none';
  });
</script>
@endsection