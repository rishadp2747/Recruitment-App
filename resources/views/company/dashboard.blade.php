@extends('layouts.company')

@section('content')
<!-- Page Heading -->
<p class="p mb-4 text-gray-800">{{ $uname }} you are successfully logged in.</p>
<div class="container bg-green rounded">
	<div class="row justify-content-center">
		<p class="h3 p-2 white bld">Quick Tour <i class="fas fa-info-circle"></i></p>
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
				<p class="text-info-3"><b class="green-but">Add Job</b> : Through this section you can post new jobs by providing the necessary informations.<br><br><b class="green-but">View Job</b> : Through this section you can view the jobs that you have posted through this dashboard.<br><br><b class="green-but">Update Job</b> : Through this section you can update the jobs that you have posted if there is any correction required.<br><br><b class="green-but">Delete Job</b> : Through this section you can delete the jobs that you have posted if they are no longer required.</p>
			</div>
		</div>
	</div>
	<div class="row p-2 justify-content-left">
		<p class="h5 p-2 white bld">2. Application Section <i class="fas fa-file-alt"></i></p>
		<div class="col-12">
			<div class="row p-2 justify-content-left">
				<p class="text-info-3"><b class="green-but">Applied Applications</b> : When a user applies for your job it first appears in the applied applications section.<br><br><b class="green-but">Reviewing Applications</b> : Once you click on know more of a application present in the applied applications section it is automatically marked as reviewing and is moved to the reviewing section (you can know more, Approve, Reject or waitlist the application from here. you can also download a excel file of all the candidates from here).<br><br><b class="green-but">Waitlisted Applications</b> : All the applications that you have marked as wailisted will be available here (you can know more, Approve or Reject the application from here. you can also download a excel file of all the candidates from here).<br><br><b class="green-but">Approved Applications</b> : All the applications that you have marked as approved will be available here (you can view the details of each applications by clicking on the know more button and you can also download a excel file of all the candidates from here).<br><br><b class="green-but">Rejected Applications</b> : All the applications that you have marked as rejected will be available here (you can view the details of each applications by clicking on the know more button).<br><br><b class="green-but">Final Applications</b> : Here you can see all the approved applications and if the the candidate is selected after the interview you can click the selected button over there to mark the candidate as selected and if the candidate failed in the interview mark the candidate as not selected.</p>
			</div>
		</div>
	</div>
</div>
@endsection