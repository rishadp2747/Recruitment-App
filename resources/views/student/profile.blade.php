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
                <p>*Please note that profile updation is only allowed once, so please cross check the data before submitting.</p>
                <p>*While uploading the photo please keep in mind that the allowed photo types are jpg and png. Maximum allowed upload size is 1MB.</p>
                <p>*While uploading the CV/certificate please keep in mind that the allowed CV/certificate type is pdf. Maximum allowed upload size is 2MB.</p>
                <p>*All certificates should be in a single pdf.</p>
            <form class="user" method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
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
                <input type="text" class="form-control form-control-user" placeholder="Name" name="name" value="@if(old('name')!== null){{ old('name') }}@elseif(isset($uname)){{ $uname }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                @error('name')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
                <div class="col-sm-6">
                <label for="qulatification">Age <span style="color:red">*</span></label>
                <input type="number" class="form-control form-control-user" placeholder="Age" name="age" value="@if(old('age')!== null){{ old('age') }}@elseif(isset($data->Age)){{ $data->Age }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                  @error('age')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                  <label for="gender">Address<span style="color:red">*</span></label>
                    <textarea class="form-control form-control-user" placeholder="Address" name="address" @if($status=='yes'){{ 'disabled' }}@endif>@if(old('address')!== null){{ old('address') }}@elseif(isset($data->Address)){{ $data->Address }}@else{{ '' }}@endif</textarea>
                    @error('address')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>

                </div>

                <div class="col-6">
                  <div class="form-group">
                  <label for="gender">Bio<span style="color:red">*</span></label>
                  <textarea class="form-control form-control-user" placeholder="Bio" name="bio" @if($status=='yes'){{ 'disabled' }}@endif>@if(old('bio')!== null){{ old('bio') }}@elseif(isset($data->Bio)){{ $data->Bio }}@else{{ '' }}@endif</textarea>
                  @error('bio')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>

                </div>
              </div>
              
              

              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                    <label for="dob">Date of Birth<span style="color:red">*</span></label>
                      <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" id="exampleInputPassword" placeholder="Date of Birth" name="dob" value="@if(old('dob')!== null){{ old('dob') }}@elseif(isset($data->DOB)){{ $data->DOB }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                      @error('dob')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-4">
                  <div class="form-group">
                     <label for="phoneno">Mobile Number<span style="color:red">*</span></label>
                      <input type="tel" class="form-control form-control-user" placeholder="Phone Number" name="phoneno" value="@if(old('phoneno')!== null){{ old('phoneno') }}@elseif(isset($data->Phoneno)){{ $data->Phoneno }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                      @error('phoneno')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-4">
                  <div class="form-group">
                  <label for="gender">Gender<span style="color:red">*</span></label>
                    <select class="form-control " name="gender" id="gender" @if($status=='yes'){{ 'disabled' }}@endif>
                      <option selected value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                      @error('gender')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                  </div>  
                </div>
              </div>

              
             

             
     
            <div class="form-group">
            <label for="exampleInputEmail1">Asap Skills</label>
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
                <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Other Skills<span style="color:red">*</span></label>
                    <textarea rows="5" class="form-control form-control-user" placeholder="Skills" name="skills" @if($status=='yes'){{ 'disabled' }}@endif>@if(old('skills')!== null){{ old('skills') }}@elseif(isset($data->Skills)){{ $data->Skills }}@else{{ '' }}@endif</textarea>
                    @error('skills')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>


                </div>

                <div class="col-6">

                <div class="form-group">
                      <label class="form-check-label" for="defaultCheck1">Volunteership</label>
                    @if($status=='no')
                      <select name="volunteership[]" class="selectpicker w-50 m-3" multiple data-live-search="true">
                        @foreach ($volunteership as $item)
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
                      <input type="number" class="form-control form-control-user" placeholder="Type your aadhaar number" name="aadhaar" value="@if(old('aadhaar')!== null){{ old('aadhaar') }}@elseif(isset($data->Aadhaar)){{ $data->Aadhaar }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                        @error('aadhaar')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                    </div>

              </div>

            </div>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                    <label class="form-check-label" for="defaultCheck1">Linkedin</label>
                    <input type="url" class="form-control form-control-user" placeholder="Linkedin URL" name="linkedin" value="@if(old('linkedin')!== null){{ old('linkedin') }}@elseif(isset($data->Linkedin)){{ $data->Linkedin }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                    @error('linkedin')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>


                </div>

                <div class="col-6">
                  <div class="form-group">
                  <label class="form-check-label" for="defaultCheck1">Git</label>
                      <input type="url" class="form-control form-control-user" placeholder="Gith URL" name="github" value="@if(old('github')!== null){{ old('github') }}@elseif(isset($data->Github)){{ $data->Github }}@else{{ '' }}@endif" @if($status=='yes'){{ 'disabled' }}@endif>
                      @error('github')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                    @enderror
                  </div>


                </div>

            
           

            </div>



    

              



  <!---
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Volunteership" name="volunteership">@if(old('volunteership')!== null){{ old('volunteership') }}@elseif(isset($data->Volunteership)){{ $data->Volunteership }}@else{{ '' }}@endif</textarea>
                @error('volunteership')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
              </div>


              -->


            

            <hr>

            <div class="acad0">
            <div class="form-group">
                <p class="op p-2">Educational Details</p>
            </div>
            @if($status=='no')
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="qulatification">Qualification <span style="color:red">*</span></label>
                    <select class="form-control" name="qualification0" id="qualification1">
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
              <div class="col-6">
                <div class="form-group">
                  <label for="qulatification">Board <span style="color:red">*</span> ( eg: CBSE, Kerala State Board ) </label>
                    <input type="text" class="form-control form-control-user" placeholder="Board" name="board0" value="@if(old('board0')!== null){{ old('board0') }}@elseif(isset($data->Board0)){{ $data->Board0 }}@else{{ '' }}@endif">
                    @error('board0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="qulatification">Institution Name<span style="color:red">*</span></label>
                    <input type="text" class="form-control form-control-user" placeholder="Institution Name" name="institution0" value="@if(old('institution0')!== null){{ old('institution0') }}@elseif(isset($data->Institution0)){{ $data->Institution0 }}@else{{ '' }}@endif">
                    @error('institution0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="percentage">Percentage<span style="color:red">*</span> (Convert cgpa into percentage) </label>
                  <input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name="cgpa0" value="@if(old('cgpa0')!== null){{ old('cgpa0') }}@elseif(isset($data->CGPA0)){{ $data->CGPA0 }}@else{{ '' }}@endif">
                    @error('cgpa0')
                    <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                <label for="join">Date of Joining<span style="color:red">*</span></label>
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of joining" name="join0" value="@if(old('join0')!== null){{ old('join0') }}@elseif(isset($data->Join0)){{ $data->Join0 }}@else{{ '' }}@endif">
                  @error('join0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror

                </div>
              </div>

              <div class="col-4">
                <div class="form-group">
                <label for="join">Date of Passing<span style="color:red">*</span></label>
                <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Year of passing" name="pass0" value="@if(old('pass0')!== null){{ old('pass0') }}@elseif(isset($data->Pass0)){{ $data->Pass0 }}@else{{ '' }}@endif">
                  @error('pass0')
                  <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                 @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="row d-none" id="qual">
              <div class="col-4">
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
         @foreach($stud_qual as $it)
         <div class="row">
           <div class="col-6">
             <div class="form-group">
               <label for="qulatification">Board</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->board)){{ $it->board }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-6">
             <div class="form-group">
               <label for="qulatification">Institution Name</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->institution)){{ $it->institution }}@else{{ '' }}@endif">
             </div>
           </div>
         </div>

         <div class="row">
           <div class="col-4">
             <div class="form-group">
               <label for="qulatification">CGPA</label>
                 <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->cgpa)){{ $it->cgpa }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-4">
             <div class="form-group">
               <label for="qulatification">Backlogs</label>
                 <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->hbacklogs)){{ $it->hbacklogs }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-4">
             <div class="form-group">
               <label for="qulatification">Current Backlogs</label>
                 <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->cbacklogs)){{ $it->cbacklogs }}@else{{ '' }}@endif">
             </div>
           </div>
         </div>

         <div class="row">
           <div class="col-4">
             <div class="form-group">
               <label for="qulatification">Date of joining</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->join)){{ $it->join }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-4">
             <div class="form-group">
               <label for="qulatification">Date of passing</label>
                 <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->pass)){{ $it->pass }}@else{{ '' }}@endif">
             </div>
           </div>

           <div class="col-4">
             <div class="form-group">
               <label for="qulatification">Qualification</label>
                 <input type="text" class="form-control form-control-user" disabled value="@foreach($qualifications as $items)@if($items->id==$it->qualification){{ $items->qualification }}@endif @endforeach">
             </div>
           </div>
         </div>
         <hr>
         @endforeach
         @endif



            <div class="row">

              <div class="col-6">
              
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


              <div class="col-6">

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


$(document).ready(function() {
  var id = 1


  $("#addQ").click(function(){

    var qual = $("#qual").html();

    qSet = $('#copyQual');

    qSet.attr('name','qualification'+id);
    //alert(qSet.attr('name'));

 
    
    

    //alert(qual);

    var row1 = "<hr><div class='row'><div class='col-4'><div class='form-group'><label for='qulatification'>Qualification <span style='color:red'>*</span></label><select class='form-control' name='qualification"+id+"' id='qualification"+id+"'>"+qSet.html()+"</select></div></div></div>";
     
    var row2 = ' <div class="row">'+
              '<div class="col-4">'+
                '<div class="form-group">'+
                  '<label for="qulatification">Board/University<span style="color:red">*</span></label>'+
                   '<input type="text" class="form-control form-control-user" placeholder="Board" name=board'+id+'>'+
                '</div>'+
              '</div>'+

              '<div class="col-4">'+
                '<div class="form-group">'+
                 '<label for="qulatification">Institution Name<span style="color:red">*</span></label>'+
                   '<input type="text" class="form-control form-control-user" placeholder="Institution Name" name=institution'+id+' >'+
                '</div>'+
              '</div>'+

              '<div class="col-4">'+
                '<div class="form-group">'+
                  '<label for="qulatification">Course Name<span style="color:red">*</span></label>'+
                    '<input type="text" class="form-control form-control-user" placeholder="Course Name" name=course'+id+'>'+
                '</div>'+
             '</div>'+
            '</div>'

    var row3 = '<div class="row">'+

                  '<div class="col-4">'+
                    '<div class="form-group">'+
                      '<label for="percentage">Percentage<span style="color:red">*</span> (Convert cgpa into percentage) </label>'+
                      '<input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name=cgpa'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-2">'+
                    '<div class="form-group">'+
                    '<label for="join">Date of Joining<span style="color:red">*</span></label>'+
                    '<input type="text" onfocus="(this.type=&#39;date&#39;)" class="form-control form-control-user" placeholder="Year of joining" name=join'+id+'>'+

                    '</div>'+
                  '</div>'+

                  '<div class="col-2">'+
                    '<div class="form-group">'+
                    '<label for="join">Date of Passing<span style="color:red">*</span></label>'+
                    '<input type="text" onfocus="(this.type=&#39;date&#39;)" class="form-control form-control-user" placeholder="Year of passing" name=pass'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-2">'+
                    '<div class="form-group">'+
                    '<label for="join">History of Backlogs<span style="color:red">*</span></label>'+
                    '<input type="number" min="1" max="100" class="form-control form-control-user" placeholder="History of Backlogs" name=hback'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-2">'+
                    '<div class="form-group">'+
                    '<label for="join">Current Backlogs<span style="color:red">*</span></label>'+
                    '<input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Current Backlogs" name=cback'+id+'>'+
                    '</div>'+
                  '</div>'+

                  '</div>'
  


    $('#addQualification').append(row1);
    $('#addQualification').append(row2);
    $('#addQualification').append(row3);

    id = id+1

    

  });

});











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