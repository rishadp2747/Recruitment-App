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
                                <p><b class="black">Salary</b> : {{ $job->Salary }}</p>
                                <p><b class="black">Minimum Qualification Required</b> : {{ $job->Min_Qualification }}</p>
                                <p><b class="black">Description</b> : {{ $job->Project_Description }}</p>
                                <p><b class="black">Skills Required</b> : {{ $job->Skills_Required }}</p>
                                <p><b class="black">Age</b> : {{ $job->Min_Age }} - {{ $job->Max_Age }}</p>
                                <p><b class="black">Job Posted on</b> : {{ $job->created_at }}</p>
                                <p><b class="black">Job Last Updated on</b> : {{ $job->updated_at }}</p>
                              </div>
                              <hr>
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-building"></i> <b>Student Details</b></p>
                              </div>
                              <div class="form-group">
                                <p><b class="black">Photo</b> : <img class="rounded-circle border-grey" width="120" height="120" src="{{ url('storage/uploads/student/photo/'.$student->Photo) }}" id="photoview"></p>
                                <p><b class="black">Email</b> : {{ $student->Email }}</p>
                                <p><b class="black">Phone</b> : {{ $student->Phoneno }}</p>
                                <p><b class="black">Address</b> : {{ $student->Address }}</p>
                                <p><b class="black">Age</b> : {{ $student->Age }}</p>
                                <p><b class="black">Date of Birth</b> : {{ $student->DOB }}</p>
                                <p><b class="black">Qualifications</b> : {{ $student->Qualifications }}</p>
                                <p><b class="black">Skills</b> : {{ $student->Skills }}</p>
                              </div>
                              <a  href="{{ url('storage/uploads/student/cv/'.$student->CV) }}" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-file-alt"></i> <b> Download applicant CV</b>
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