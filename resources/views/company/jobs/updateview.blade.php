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
                  <input type="text" class="form-control form-control-user" placeholder="Job Title" name="title" value="{{ $jobs->Job_Title }}" required autocomplete="title">
                  @error('title')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('title') }}</p>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <input type="number" class="form-control form-control-user" placeholder="Salary" name="salary" value="{{ $jobs->Salary }}" required autocomplete="salary">
                  @error('salary')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('salary') }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control form-control-user" placeholder="Job Description" name="description" required autocomplete="description">{{ $jobs->Project_Description }}</textarea>
                @error('description')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('description') }}</p>
                  @enderror
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="number" class="form-control form-control-user" placeholder="Applicant Min Age" name="minage" value="{{ $jobs->Min_Age }}" required autocomplete="minage">
                  @error('minage')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('minage') }}</p>
                  @enderror
                </div>
                <div class="col-sm-6">
                  <input type="number" class="form-control form-control-user" placeholder="Applicant Max Age" name="maxage" value="{{ $jobs->Max_Age }}" required autocomplete="maxage">
                  @error('maxage')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('maxage') }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="Skills Required" name="skills" value="{{ $jobs->Skills_Required }}" required autocomplete="skills">
                  @error('skills')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('skills') }}</p>
                  @enderror
                  </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" placeholder="Minimum Quaification Required" name="qualification" value="{{ $jobs->Min_Qualification }}" required autocomplete="qualification">
                  @error('qualification')
                   <p class="p-2 red-alert" role="alert">{{ $message }} Value which you entered was {{ old('qualification') }}</p>
                  @enderror
                </div>
                <input type="hidden" name="id" value="{{ $jobs->Job_Id }}">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Update Job
                </button>
            </form>
          </div>
        </div>
    </div>
  </div>
@endsection