@extends('layouts.student')

@section('content')
<!-- Page Heading -->
<p class="p mb-4 text-gray-800">{{ $uname }} you are successfully logged in.</p>
  @if($p_status=='yes')
  <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jobs Applied</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tools fa-2x blue"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Applications Reviewing</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count_rev }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-eye fa-2x black"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Applications Approved</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count_app }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check-circle fa-2x green"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Applications Rejected</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count_rej }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-times-circle fa-2x red"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Applications Selected</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count_sel }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-check fa-2x green"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Applications Not Selected</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count_not }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-times-circle fa-2x red"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  </div>
  @endif
<div class="container bg-blue rounded">
	<div class="row justify-content-center">
		<p class="h3 p-2 white bld">Quick Tour <i class="far fa-laugh-wink"></i></p>
	</div>
	@if($p_status=='no')
	<div class="row p-1 justify-content-center">
		<div class="container">
			<div class="col-12">
		        <div class="row justify-content-center red-b-white">
			        <div class="col-sm-1 align-self-center">
			        	<div class="row p-1 justify-content-center">
				            <i class="fas fa-exclamation-triangle text-info-2"></i>
				        </div>
			        </div>
			        <div class="col-sm-11">
			        	<div class="row p-1 justify-content-left">
				            <p class="text-info-1">In order to do any operation in this dashboard you have to complete yoour profile first. Complete your profie by <a class="inf-but" href="./dashboard/profile">clicking here</a> !</p>
				        </div>
			        </div>
		        </div>
	        </div>
		</div>
	</div>
	@endif
	<div class="row p-2 justify-content-left">
		<p class="h5 p-2 white bld">1. Jobs Section <i class="fas fa-tools"></i></p>
		<div class="col-12">
			<div class="row p-2 justify-content-left">
				<p class="text-info-3"><b class="blue-but">Available Jobs</b> : In this section you can see all the jobs that are available. By clicking on the know more button available on each jobs listed, you will be taken to the job details page. Read the requirements carefully and apply for the job by clicking the appy button only if you are fully quallified for the job.<br><br><b class="blue-but">Applied Jobs</b> : In this section you can see all the jobs that you have applied for. By clicking on the know more button you can see the complete details about your application.</p>
			</div>
		</div>
	</div>
</div>
@endsection