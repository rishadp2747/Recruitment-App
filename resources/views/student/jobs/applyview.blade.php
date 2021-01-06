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
                                <p class="jobhead"><i class="fas fa-wrench"></i> <b>Job Details</b></p>
                              </div>
                              <div class="form-group">
                                <p><b class="black">Title</b> : {{ $dataj->Job_Title }}</p>
                                @php
                              $gh = 1;
                             @endphp
                           @foreach($comp_qual as $it)
                                       <div class="form-group">
                                           <p class="op p-2">Minimum Education Required {{ $gh }}</p>
                                       </div>
                                       @php
                                        $gh = $gh +1;
                                       @endphp
                                    <div class="row">
                                     
                                     <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Qualification</label>
                                            <input type="text" class="form-control form-control-user" disabled value="@foreach($qualifications as $items)@if($items->id==$it->qualification){{ $items->qualification }}@endif @endforeach">
                                        </div>
                                      </div>

                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Course</label>
                                            <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->course)){{ $it->course }}@else{{ '' }}@endif">
                                        </div>
                                      </div>

                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Specialisation</label>
                                            <input type="text" class="form-control form-control-user" disabled value="@if(isset($it->specialisation)){{ $it->specialisation }}@else{{ '' }}@endif">
                                        </div>
                                      </div>

                                    </div>
                           
                                    <div class="row">
                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">CGPA/Percentage</label>
                                            <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->cgpa)){{ $it->cgpa }}@else{{ '' }}@endif">
                                        </div>
                                      </div>
                           
                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Maximum Backlogs</label>
                                            <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->hbacklogs)){{ $it->hbacklogs }}@else{{ '' }}@endif">
                                        </div>
                                      </div>
                           
                                      <div class="col-4">
                                        <div class="form-group">
                                          <label for="qulatification">Maximum Current Backlogs</label>
                                            <input type="number" class="form-control form-control-user" disabled value="@if(isset($it->cbacklogs)){{ $it->cbacklogs }}@else{{ '' }}@endif">
                                        </div>
                                      </div>
                                    </div>
                                    <hr>
                                    @endforeach
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
                              <a  href="#" data-toggle="modal" data-target="#applyModal" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-file-alt"></i> <b> Apply for job</b>
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
                        <h5 class="modal-title" id="exampleModalLabel">Apply for the job ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Are you sure do you want to apply for this job ? Your data provided in the profile page will be automatically submitted to the company. Please make sure that you are fully qualified to apply for the job by cross checking the job details section.</div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('apply-form').submit();" style="color:#fff;">Apply</a>
                        <form id="apply-form" action="{{ route('applyJob') }}" method="POST">
                                  @csrf
                          <input type="hidden" name="j_id" value="{{ $id }}">
                          <input type="hidden" name="email" value="{{ $datac->Email }}">
                          <input type="hidden" name="title" value="{{ $dataj->Job_Title }}">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>         

@endsection                