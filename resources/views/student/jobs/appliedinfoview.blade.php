@extends('layouts.student')

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
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                      <!-- Nested Row within Card Body -->
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="p-5">
                            @if(isset($dataj->Job_Title))
                            <form class="user">
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-file"></i> <b>Application Status</b></p>
                              </div>
                              <div class="form-group">
                                @if($status=="Submitted")
                                <div class="alert alert-primary">
                                     Great ! your application has been {!! $status !!}.
                                </div>
                             @elseif($status=="Reviewing")
                                <div class="alert alert-warning">
                                     Hold tight ! your application is under {!! $status !!} stage.
                                </div>
                             @elseif($status=="Waitlisted")
                                <div class="alert alert-dark">
                                     Sit back ! your application has been {!! $status !!}.
                                </div>
                             @elseif($status=="Approved")
                                <div class="alert alert-success">
                                     Hurray ! your application has been {!! $status !!}.
                                </div>
                                @elseif($status=="Selected")
                                <div class="alert alert-success">
                                     All set ! your application has been {!! $status !!}.
                                </div>
                                @elseif($status=="NotSelected")
                                <div class="alert alert-danger">
                                     Gone at last ! your application has been {!! $status !!}.
                                </div>
                             @elseif($status=="Rejected")
                                <div class="alert alert-danger">
                                     Sorry to say that ! your application has been {!! $status !!}.
                                </div>
                             @endif
                                <p><b class="black">Submitted On</b> : {{ $date }}</p>
                              </div>
@if($status=="Rejected")
<div class="text-center status-show-red p-2">
          <i class="fas fa-times-circle"></i> Application Rejected on {{ $date_up }}
        </div>
@elseif($status=="Approved")
        <div class="text-center status-show-green p-2">
          <i class="fas fa-check-circle"></i> Application Approved on {{ $date_up }}
        </div>
@elseif($status=="Selected")
        <div class="text-center status-show-green p-2">
          <i class="fas fa-check-circle"></i> Application Selected on {{ $date_up }}. Congratulation on your new job.
        </div>
@elseif($status=="NotSelected")
        <div class="text-center status-show-red p-2">
          <i class="fas fa-times-circle"></i> Application Not Selected on {{ $date_up }}. You made it till the last, keep trying.
        </div>
@endif
                              <hr>
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-wrench"></i> <b>Job Details</b></p>
                              </div>
                              <div class="form-group">
                                <p><b class="black">Title</b> : {{ $dataj->Job_Title }}</p>
                                <p><b class="black">Minimum Qualification Required</b> : @if(!empty($dataj->qualification))@foreach($qualifications as $item)@if($dataj->qualification==$item->id){{ $item->qualification }}@endif @endforeach @else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Course</b> : @if(!empty($dataj->course)){{ $dataj->course }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Minimum Percentage</b> : @if(!empty($dataj->cgpa)){{ $dataj->cgpa.'%' }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Maximum Backlogs</b> : @if(!empty($dataj->hbacklogs)){{ $dataj->hbacklogs }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Maximum Current Backlogs</b> : @if(!empty($dataj->cbacklogs)){{ $dataj->cbacklogs }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Skills Required</b> : @if(!empty($dataj->Skills_Required)){{ $dataj->Skills_Required }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Minimum Age</b> : @if(!empty($dataj->Min_Age)){{ $dataj->Min_Age }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Maximum Age</b> : @if(!empty($dataj->Max_Age)){{ $dataj->Max_Age }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Preferred Gender</b> : @if(!empty($dataj->gender)){{ $dataj->gender }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Last Date for applying</b> : @if(!empty($dataj->last_date)){{ $dataj->last_date }}@else{{ 'Not Specified' }}@endif</p>
                                <p><b class="black">Job Posted on</b> : {{ $dataj->created_at }}</p>
                                <p><b class="black">Job Last Updated on</b> : {{ $dataj->updated_at }}</p>
                              </div>
                              <hr>
                              <div class="form-group">
                                <p class="jobhead"><i class="fas fa-building"></i> <b>Company Details</b></p>
                              </div>
                              <div class="form-group">
                                <p><b class="black">Logo</b> : <img class="rounded-circle border-grey" width="120" height="120" src="{{ url('storage/uploads/company/photo/'.$datac->Photo) }}" id="photoview"></p>
                                <p><b class="black">Company Name</b> : {{ $c_name->name }}</p>
                                <p><b class="black">Company Website</b> : {{ $datac->URL }}</p>
                              </div>
                              @if($status=="Submitted")
                              <a  href="#" data-toggle="modal" data-target="#applyModal" class="btn btn-danger btn-user btn-block">
                                <i class="far fa-trash-alt"></i> <b> Withdraw Application</b>
                              </a>
                              @endif
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
                      <div class="modal-body">Are you sure do you want to withdraw the application that you have submitted and whose status is "{{ $status }}" ? You cannot reverse this process.</div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" onclick="event.preventDefault();document.getElementById('apply-form').submit();" style="color:#fff;">Withdraw Application</a>
                        <form id="apply-form" action="{{ route('deleteappliedJob') }}" method="POST">
                                  @csrf
                          <input type="hidden" name="u_id" value="{{ $id }}">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>         

@endsection                