@extends('layouts.company')

@section('content')
@php
$qual_num = 0;
@endphp
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-plus-square"></i> <b>Add Job</b></h1>
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
            <form class="user" method="POST" action="{{ route('addJobs') }}">
            @csrf
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="title" class="mx-1" style="color:#161616;"><b>Job Title</b><span style="color:red"> *</span></label>
                  <input type="text" min="1" max="100" class="form-control form-control-user" placeholder="Job Title" name="title" value="{{ old('title') }}" required autocomplete="title">
                  @error('title')
                   <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label for="gender" style="color:#161616;"><b>Prefered Gender</b></label>
                    <select class="form-control " name="gender" id="gender">
                      <option value="">Select</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="any">Any</option>
                    </select>
                      @error('gender')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="mx-1" for="minage" style="color:#161616;"><b>Min Age</b></label>
                  <input type="number" class="form-control form-control-user" min="18" max="100" placeholder="Applicant Min Age" name="minage" value="{{ old('minage') }}" autocomplete="minage">
                  @error('minage')
                   <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="mx-1" for="maxage" style="color:#161616;"><b>Max Age</b></label>
                  <input type="number" class="form-control form-control-user" min="18" max="100" placeholder="Applicant Max Age" name="maxage" value="{{ old('maxage') }}" autocomplete="maxage">
                  @error('maxage')
                   <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label class="mx-1" for="skills" style="color:#161616;"><b>Skills Required</b></label>
                  <input type="text" min="1" max="100" class="form-control form-control-user" placeholder="Skills Required" name="skills" value="{{ old('skills') }}" autocomplete="skills">
                  @error('skills')
                   <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                  @enderror
                  </div>
                  <div class="form-group">
                    <p class="op p-1">Minimum Educational Qualification 1</p>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="qualification0" style="color:#161616;"><b>Qualification</b></label>
                        <select class="form-control" name="qualification0" id="qualification0">
                          <option value='' >Select</options>
                            @foreach ($qualifications as $item)
                                <option value='{{$item->id}}' @if($item->id==old('qualification0')){{'selected'}}@endif>{{$item->qualification}}</options>
                              @endforeach
                        </select>
                          @error('qualification0')
                            <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                          @enderror
                      </div>
                  </div> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="mx-1" for="cgpa0" style="color:#161616;"><b>Percentage</b> (Convert cgpa into percentage)</label>
                      <input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name="cgpa0" value="@if(old('cgpa0')!== null){{ old('cgpa0') }}@else{{ '' }}@endif" id="cgpa0">
                        @error('cgpa0')
                        <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="mx-1" for="course0" style="color:#161616;"><b>Course Name</b></label>
                        <input type="text" min="1" max="100" class="form-control form-control-user" placeholder="Course Name" value="{{ old('course0') }}" name="course0" id="course0">
                          @error('course0')
                            <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                          @enderror
                    </div>
                   </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                      <label class="mx-1" for="specialisation0" style="color:#161616;"><b>Specialisation</b></label>
                        <input type="text" min="1" max="150" class="form-control form-control-user" placeholder="Specialisation" value="{{ old('specialisation0') }}" name="specialisation0">
                          @error('specialisation0')
                            <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                          @enderror
                    </div>
                   </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="mx-1" for="hbacklogs0" style="color:#161616;"><b>History of Backlogs</b></label>
                          <input type="number" min="0" max="100" class="form-control form-control-user" placeholder="input a number" name="hbacklogs0" id="hbacklogs0" value="{{ old('hbacklogs0') }}">
                          @error('hbacklogs0')
                                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                          @enderror
                      </div>
                    </div>
         
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="mx-1" for="cbacklogs0" style="color:#161616;"><b>Current Backlogs</b></label>
                          <input type="number" min="0" max="100" class="form-control form-control-user" placeholder="input a number" name="cbacklogs0" id="cbacklogs0" value="{{ old('cbacklogs0') }}">
                          @error('cbacklogs0')
                                     <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                          @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row d-none" id="qual">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="qulatification">Qualification <span style="color:red">*</span></label>
                    <select class="form-control" name="qualification" id="copyQual">
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
                  <div class="form-group">
                    <label class="mx-1" for="last" style="color:#161616;"><b>Last date to apply</b></label>
                    <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Date" name="last" value="@if(old('last')!== null){{ old('last') }}@else{{ '' }}@endif">
                      @error('last')
                      <p class="p-2 red-alert" role="alert">{{ $message }}</p>
                     @enderror
                    </div>
                    <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="ok" required>
                  <label class="form-check-label" for="defaultCheck1">
                      I here by delcare that, the information that i collect from the ASAP Placement portal will not be used for any other purpose.
                  </label>
                  </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Add Job
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
     
    var row1 =  '<hr>'+
                '<div class="form-group">'+
                    '<p class="op p-1">Minimum Educational Qualification '+(id+1)+'</p>'+
                '</div>'+
                '<div class="row">'+
                 "<div class='col-sm-4'><div class='form-group'><label for='qualification0' style='color:#161616;'><b>Qualification</b></label><select class='form-control' name='qualification"+id+"' id='qualification"+id+"' onchange='qualChange("+id+")'><option value='' >Select</options>"+qSet.html()+"</select></div></div>"+

                 '<div class="col-sm-4">'+
                    '<div class="form-group">'+
                      '<label class="mx-1" for="cgpa'+id+'" style="color:#161616;"><b>Percentage</b> (Convert cgpa into percentage)</label>'+
                      '<input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name="cgpa'+id+'"  id="cgpa'+id+'">'+
                    '</div>'+
                  '</div>'+
                 
                 '<div class="col-sm-4">'+
                  '<div class="form-group">'+
                   '<label class="mx-1" for="course0" style="color:#161616;"><b>Course Name</b></label>'+
                    '<input type="text" min="1" max="100" class="form-control form-control-user" placeholder="Course Name" name="course'+id+'" id="course'+id+'">'+
                '</div>'+
             '</div>'+

              '</div>'

    var row2 = '<div class="row">'+
               
               '<div class="col-12">'+
                '<div class="form-group">'+
                  '<label class="mx-1" for="specialisation0" style="color:#161616;"><b>Specialisation</b></label>'+
                    '<input type="text" min="1" max="150" class="form-control form-control-user" placeholder="Specialisation" name="specialisation'+id+'" id="specialisation'+id+'">'+
                '</div>'+
             '</div>'+

               '</div>'

    var row3 = '<div class="row">'+

                  '<div class="col-sm-6">'+
                    '<div class="form-group">'+
                    '<label class="mx-1" for="hbacklogs0" style="color:#161616;"><b>History of Backlogs</b></label>'+
                    '<input type="number" min="0" max="100" class="form-control form-control-user" placeholder="input a number" name="hbacklogs'+id+'" id="hbacklogs'+id+'">'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-sm-6">'+
                    '<div class="form-group">'+
                    '<label class="mx-1" for="cbacklogs0" style="color:#161616;"><b>Current Backlogs</b></label>'+
                    '<input type="number" min="0" max="100" class="form-control form-control-user" placeholder="input a number" name="cbacklogs'+id+'" id="cbacklogs'+id+'">'+
                    '</div>'+
                  '</div>'+

                  '</div>'
  


    $('#addQualification').append(row1);
    $('#addQualification').append(row2);
    $('#addQualification').append(row3);

    id = id+1

    if(id==qual_num){
       $("#addQ").remove();
    }

  });

});
</script>
@endsection