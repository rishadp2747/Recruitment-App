@extends('layouts.company')

@section('content')
          <!-- DataTales Example -->
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
                <p>Control the application submitted by the student</p>
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                      <!-- Nested Row within Card Body -->
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="p-5">
                            @if(isset($applied->U_Id))
                            <form class="user">
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-file"></i> <b>Application Status</b></p>
                              </div>
                              <div class="form-group">
                                @if($applied->Status=="Submitted")
                                <div class="alert alert-primary">
                                    Application Status : {!! $applied->Status !!}.
                                </div>
                             @elseif($applied->Status=="Reviewing")
                                <div class="alert alert-warning">
                                     Application Status : {!! $applied->Status !!}.
                                </div>
                             @elseif($applied->Status=="Waitlisted")
                                <div class="alert alert-dark">
                                    Application Status : {!! $applied->Status !!}.
                                </div>
                             @elseif($applied->Status=="Approved")
                                <div class="alert alert-success">
                                    Application Status : {!! $applied->Status !!}.
                                </div>
                             @elseif($applied->Status=="Rejected")
                                <div class="alert alert-danger">
                                    Application Status : {!! $applied->Status !!}.
                                </div>
                             @endif
                                <p><b class="black">Submitted On</b> : {{ $applied->created_at }}</p>
                              </div>
    @if($applied->Status=="Waitlisted" || $applied->Status=="Reviewing")
				<div class="text-center">
                  <p class="op">Operations on application : </p>
                </div>
				@if($applied->Status!="Waitlisted")
                <div class="form-group row">
                  <div class="col-sm-4">
                    <div class="row justify-content-center p-2">
                    <a class="btn btn-dark btn-block" href="#" data-toggle="modal" data-target="#waitModal"><i class="fas fa-clock"></i> Add to waitlist</a>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="row justify-content-center p-2">
                    <a class="btn btn-success btn-block" href="#" data-toggle="modal" data-target="#selectModal"><i class="fas fa-check-circle"></i> Select/Approve</a>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="row justify-content-center p-2">
                    <a class="btn btn-danger btn-block" href="#" data-toggle="modal" data-target="#rejectModal"><i class="fas fa-times-circle"></i> Reject</a>
                    </div>
                  </div>
                </div>
          @else
                <div class="form-group row">
                  <div class="col-sm-6">
                    <div class="row justify-content-center p-2">
                    <a class="btn btn-success btn-block" href="#" data-toggle="modal" data-target="#selectModal"><i class="fas fa-check-circle"></i> Select/Approve</a>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="row justify-content-center p-2">
                    <a class="btn btn-danger btn-block" href="#" data-toggle="modal" data-target="#rejectModal"><i class="fas fa-times-circle"></i> Reject</a>
                    </div>
                  </div>
                </div>
				@endif
@endif
@if($applied->Status=="Rejected")
<div class="text-center status-show-red p-2">
          <i class="fas fa-times-circle"></i> Application Rejected on {{ $applied->updated_at }}
        </div>
@elseif($applied->Status=="Approved")
        <div class="text-center status-show-green p-2">
          <i class="fas fa-check-circle"></i> Application Approved on {{ $applied->updated_at }}
        </div>
@endif
                              <hr>
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-wrench"></i> <b>Job Details</b></p>
                              </div>
                              <div class="form-group">
                                <p><b class="black">Title</b> : {{ $job->Job_Title }}</p>
                                <p><b class="black">Minimum Qualification Required</b> : @if(!empty($job->qualification))@foreach($qualifications as $item)@if($job->qualification==$item->id){{ $item->qualification }}@endif @endforeach @else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Course</b> : @if(!empty($job->course)){{ $job->course }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Minimum Percentage</b> : @if(!empty($job->cgpa)){{ $job->cgpa.'%' }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Maximum Backlogs</b> : @if(!empty($job->hbacklogs)){{ $job->hbacklogs }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Maximum Current Backlogs</b> : @if(!empty($job->cbacklogs)){{ $job->cbacklogs }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Skills Required</b> : @if(!empty($job->Skills_Required)){{ $job->Skills_Required }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Minimum Age</b> : @if(!empty($job->Min_Age)){{ $job->Min_Age }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Maximum Age</b> : @if(!empty($job->Max_Age)){{ $job->Max_Age }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Preferred Gender</b> : @if(!empty($job->gender)){{ $job->gender }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Last Date for applying</b> : @if(!empty($job->last_date)){{ $job->last_date }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Job Posted on</b> : {{ $job->created_at }}</p>
                                <p><b class="black">Job Last Updated on</b> : {{ $job->updated_at }}</p>
                              </div>
                              <hr>
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-building"></i> <b>Student Details</b></p>
                              </div>
                              <div class="form-group">
                                <p><b class="black">Photo</b> : <img class="rounded-circle border-grey" width="120" height="120" src="{{ url('storage/uploads/student/photo/'.$student->Photo) }}" id="photoview"></p>
                                <p><b class="black">Full Name</b> : @if(!empty($stud_n->name)){{ $stud_n->name }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Email</b> : @if(!empty($student->Email)){{ $student->Email }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Phone</b> : @if(!empty($student->Phoneno)){{ $student->Phoneno }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Gender</b> : @if(!empty($student->Gender)){{ $student->Gender }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Address</b> : @if(!empty($student->Address)){{ $student->Address }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Aadhaar Number</b> : @if(!empty($student->Aadhaar)){{ $student->Aadhaar }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Age</b> : @if(!empty($student->Age)){{ $student->Age }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Date of Birth</b> : @if(!empty($student->DOB)){{ $student->DOB }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Bio</b> : @if(!empty($student->Bio)){{ $student->Bio }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Skills</b> : @if(!empty($student->Skills)){{ $student->Skills }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">ASAP Skills</b> : @if(!empty($student->Asap_Skills)){{ $student->Asap_Skills }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Volunteership</b> : @if(!empty($student->Volunteership)){{ $student->Volunteership }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Linkedin url</b> : @if(!empty($student->Linkedin))<a target="_blank" href='{{ $student->Linkedin }}'>{{ $student->Linkedin }}</a>@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Git url</b> : @if(!empty($student->Github))<a target="_blank" href='{{ $student->Github }}'>{{ $student->Github }}</a>@else{{ 'Not Specified' }}@endif</p>
                              </div>
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
                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Board</label>
                                            <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->board)){{ $it->board }}@else{{ '' }}@endif">
                                        </div>
                                      </div>
                           
                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Institution Name</label>
                                            <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->institution)){{ $it->institution }}@else{{ '' }}@endif">
                                        </div>
                                      </div>

                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Course</label>
                                            <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->course)){{ $it->course }}@else{{ '' }}@endif">
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
                              <a  href="{{ url('storage/uploads/student/cv/'.$student->CV) }}" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-file-alt"></i> <b> Download applicant CV</b>
                              </a>
                              <a  href="{{ url('storage/uploads/student/certificates/'.$student->Certificates) }}" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-file-alt"></i> <b> Download applicant Certificates</b>
                              </a>
                            </form>
                            @else 
                            <div class="text-center">No job data available</div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <!-- Apply Modal-->
                <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete your job application ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Are you sure do you want to withdraw the application that you have submitted and whose status is  ? You cannot reverse this process.</div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" onclick="event.preventDefault();document.getElementById('apply-form').submit();" style="color:#fff;">Withdraw Application</a>
                        <form id="apply-form" action="{{ route('deleteappliedJob') }}" method="POST">
                                  @csrf
                          <input type="hidden" name="u_id" value="">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>   
                
                <!-- Wait list Modal-->
  <div class="modal fade" id="waitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Waitlist the application ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure do you want to waitlist this application ? then please click on waitlist button.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('wait-form').submit();" style="color:#fff;">Waitlist</a>
          <form id="wait-form" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $applied->U_Id }}">
                <input type="hidden" name="status" value="Waitlisted">
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Approve Modal-->
  <div class="modal fade" id="selectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select/Approve Application ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure do you want to Select/Approve this application ? then please click on approve button. Please note that this process cannot be reversed.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success" onclick="event.preventDefault();document.getElementById('approve-form').submit();" style="color:#fff;">Approve</a>
          <form id="approve-form" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $applied->U_Id }}">
                <input type="hidden" name="status" value="Approved">
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Reject Modal-->
  <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reject the application ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure do you want to Reject this application ? then please click on reject button. Please note that this process cannot be reversed.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" onclick="event.preventDefault();document.getElementById('reject-form').submit();" style="color:#fff;">Reject</a>
          <form id="reject-form" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $applied->U_Id }}">
                <input type="hidden" name="status" value="Rejected">
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

@endsection                