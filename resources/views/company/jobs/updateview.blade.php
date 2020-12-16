@extends('layouts.company')

@section('content')
@php
 if(isset($jobs)){
 $jobs = $jobs[0];  
 } 
@endphp
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-12">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-pencil-alt"></i> <b>Update Job</b></h1>
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
            <form class="user" method="POST" action="{{ route('updateJobDB') }}">
            @csrf
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="title" class="mx-1" style="color:#161616;"><b>Job Title</b><span style="color:red"> *</span></label>
                  <input type="text" class="form-control form-control-user" placeholder="Job Title" name="title" value="{{ $jobs->Job_Title }}" required autocomplete="title">
                  @error('title')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('title') }}</p>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label for="gender" style="color:#161616;"><b>Prefered Gender</b></label>
                    <select class="form-control " name="gender" id="gender">
                      <option value="" @if($jobs->gender==''){{ 'selected' }}@endif>Select</option>
                      <option value="male" @if($jobs->gender=='male'){{ 'selected' }}@endif>Male</option>
                      <option value="female" @if($jobs->gender=='female'){{ 'selected' }}@endif>Female</option>
                      <option value="any" @if($jobs->gender=='any'){{ 'selected' }}@endif>Any</option>
                    </select>
                      @error('gender')
                        <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('gender') }}</p>
                      @enderror
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="mx-1" for="minage" style="color:#161616;"><b>Min Age</b></label>
                  <input type="number" class="form-control form-control-user" min="18" max="100" placeholder="Applicant Min Age" name="minage" value="{{ $jobs->Min_Age }}" autocomplete="minage">
                  @error('minage')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('minage') }}</p>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <label class="mx-1" for="maxage" style="color:#161616;"><b>Max Age</b></label>
                  <input type="number" class="form-control form-control-user" min="18" max="100" placeholder="Applicant Max Age" name="maxage" value="{{ $jobs->Max_Age }}" autocomplete="maxage">
                  @error('maxage')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('maxage') }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label class="mx-1" for="skills" style="color:#161616;"><b>Skills Required</b></label>
                  <input type="text" class="form-control form-control-user" placeholder="Skills Required" name="skills" value="{{ $jobs->Skills_Required }}" autocomplete="skills">
                  @error('skills')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('skills') }}</p>
                  @enderror
                  </div>
                  <div class="form-group">
                    <p class="op p-1">Minimum Educational Qualification</p>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="qualification" style="color:#161616;"><b>Qualification</b></label>
                        <select class="form-control" name="qualification" id="qualification1">
                          <option value='' >Select</options>
                            @foreach ($qualifications as $item)
                                <option value='{{$item->id}}' @if($jobs->qualification==$item->id){{ 'selected' }}@endif>{{$item->qualification}}</options>
                              @endforeach
                        </select>
                          @error('qualification')
                            <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('quaification') }}</p>
                          @enderror
                      </div>
                  </div> 
                  <div class="col-4">
                    <div class="form-group">
                      <label class="mx-1" for="cgpa" style="color:#161616;"><b>Percentage</b> (Convert cgpa into percentage)</label>
                      <input type="number" min="1" max="100" class="form-control form-control-user" placeholder="Percentage" name="cgpa" value="{{ $jobs->cgpa }}">
                        @error('cgpa')
                        <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('cgpa') }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label class="mx-1" for="course" style="color:#161616;"><b>Course Name</b></label>
                        <input type="text" class="form-control form-control-user" placeholder="Course Name" value="{{ $jobs->course }}" name="course">
                          @error('course')
                            <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('course') }}</p>
                          @enderror
                    </div>
                   </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label class="mx-1" for="hbacklogs" style="color:#161616;"><b>Backlogs</b></label>
                          <input type="number" class="form-control form-control-user" name="hbacklogs" value="{{ $jobs->cbacklogs }}">
                          @error('hbacklogs')
                                     <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('hbacklogs') }}</p>
                          @enderror
                      </div>
                    </div>
         
                    <div class="col-6">
                      <div class="form-group">
                        <label class="mx-1" for="cbacklogs" style="color:#161616;"><b>Current Backlogs</b></label>
                          <input type="number" class="form-control form-control-user" name="cbacklogs" value="{{ $jobs->hbacklogs }}">
                          @error('cbacklogs')
                                     <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('cbacklogs') }}{{ $message }}</p>
                          @enderror
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="mx-1" for="last" style="color:#161616;"><b>Last date to apply</b></label>
                    <input type="text" onfocus="(this.type='date')" class="form-control form-control-user" placeholder="Date" name="last" value="{{ $jobs->last_date }}">
                      @error('last')
                      <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('last') }}</p>
                     @enderror
                    </div>
                <input type="hidden" name="id" value="{{ $jobs->Job_Id }}">
                <div class="form-group">
                    <input class="form-check-input" type="checkbox" name="ok" required>
                  <label class="form-check-label" for="defaultCheck1">
                      I here by delcare that, the information that i collect from the ASAP Placement portal will not be used for any other purpose.
                  </label>
                  </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Update Job
                </button>
            </form>
          </div>
        </div>
    </div>
  </div>
@endsection