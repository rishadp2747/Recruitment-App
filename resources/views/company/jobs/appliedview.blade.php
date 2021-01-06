@extends('layouts.company')

@section('content')
@php
   $i = 0; 
@endphp
@php
$route = Route::currentRouteName();

if($route=='approvedJob'){
$path = public_path('storage/uploads/company/students/approved'.str_replace(' ', '', strtolower($uname)).'.csv');
$path_url = url('storage/uploads/company/students/approved'.str_replace(' ', '', strtolower($uname)).'.csv');
}
elseif($route=='reviewingJob'){
$path = public_path('storage/uploads/company/students/reviewing'.str_replace(' ', '', strtolower($uname)).'.csv');
$path_url = url('storage/uploads/company/students/reviewing'.str_replace(' ', '', strtolower($uname)).'.csv');
}
elseif($route=='waitlistedJob'){
$path = public_path('storage/uploads/company/students/waitlisted'.str_replace(' ', '', strtolower($uname)).'.csv');
$path_url = url('storage/uploads/company/students/waitlisted'.str_replace(' ', '', strtolower($uname)).'.csv');
}

if($route=='approvedJob' || $route=='reviewingJob' || $route=='waitlistedJob'){
if(file_exists($path)){
   File::delete($path);
}
}
if(isset($applied) && isset($stud_det)){
$max_qual = $data_num;
$numb = 0;
$numb2 = 0;
$name_arr = array('Index','Application Id','Job Id','Job Name','Applied On','Application Status','Student Email','Job Title','Status','Age','DOB','Phone No.','Skills','Volunteership','Linkedin URL','Github URL','Bio','Gender','Asap_Skills','Aadhaar');
for($x=1;$x<=$max_qual;$x++){
  $n1 = 'Qualification '.(string)$x;
  $n2 = 'Course '.(string)$x;
  $n3 = 'Specialisation '.(string)$x;
  $n4 = 'Percentage '.(string)$x;
  $n5 = 'Board '.(string)$x;
  $n6 = 'Institution '.(string)$x;
  $n7 = 'Joining Date '.(string)$x;
  $n8 = 'Passing Date '.(string)$x;
  $n9 = 'Current Backlogs '.(string)$x;
  $n10 = 'History of Backlogs '.(string)$x;
  array_push($name_arr,$n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8,$n9,$n10);
}
  foreach($applied as $ap){
    $numb = $numb +1;
    ${"new" . $numb} = array($numb,$ap->U_Id,$ap->Job_Id,$ap->Job_Title,$ap->created_at,$ap->Status,$ap->Student_Email,$ap->Job_Title,$ap->Status);
  }
  $hg = 0;
  foreach($stud_det as $st){
    $numb2 = $numb2 +1;
    ${"new_2" . $numb2} = array($st->Age,$st->DOB,$st->Phoneno,$st->Skills,$st->Volunteership,$st->Linkedin,$st->Github,$st->Bio,$st->Gender, $st->Asap_Skills,$st->Aadhaar);
    ${"new_3" . $numb2} = array();
      foreach($stud_qual[$hg] as $fin){
        if($fin->qualification==1){
            $qua = '10th';
        }
        elseif($fin->qualification==2){
            $qua = '12th';
        }
        elseif($fin->qualification==3){
            $qua = 'Post Graduation';
        }
        array_push(${"new_3" . $numb2},$qua,$fin->course,$fin->specialisation,$fin->cgpa,$fin->board,$fin->institution,$fin->join,$fin->pass,$fin->cbacklogs,$fin->hbacklogs);  
      }
      $hg = $hg + 1;
    ${"final" . $numb2} = (array_merge(${"new" . $numb2},${"new_2" . $numb2},${"new_3" . $numb2}));
  }
$fp = fopen($path, 'w');
fputcsv($fp, $name_arr);
for($f=1;$f<=$numb;$f++){
	fputcsv($fp, ${"final" . $f});
}
fclose($fp);
}

@endphp
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
          <p class="mb-4">For further details click on know more.</p>
          @if (($route=='approvedJob' || $route=='reviewingJob' || $route=='waitlistedJob') && isset($applied))
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-file-excel"></i> <b>Export To Excel</b></h1>
                    </div>
                      <a href="{{ $path_url }}" class="btn btn-success btn-user btn-block"><b>Download File</b></a>
                   </div>
                </div>
            </div>
            </div>
        </div>
        @endif
          <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $info }}</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Application Id</th>
                      <th>Job Title</th>
                      <th>Student Name</th>
                      <th>Applied On</th>
                      <th>Status</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Application Id</th>
                      <th>Job Title</th>
                      <th>Student Name</th>
                      <th>Applied On</th>
                      <th>Status</th>
                      <th>Operation</th>
                    </tr>
                  </tfoot>
                  <tbody>
@if(isset($applied))
@foreach ($applied as $item)
   <tr>
   <td>{{$item->U_Id}}</td>
   <td>{{$item->Job_Title}}</td>
   <td>{{$name[$i]->name}}</td>
   <td>{{$item->created_at}}</td>
   <td>{{$item->Status}}</td>
   <td><a href="/dashboard/jobs/company/applied/{{ $item->U_Id }}" class="btn btn-facebook btn-block"><i class="fas fa-info-circle"></i> Know More</a>
   @if($route=='reviewingJob')
   <a class="btn btn-block btn-dark" onclick="event.preventDefault();document.getElementById('wait-form{{ $i }}').submit();" style="color:#fff;"><i class="fas fa-clock"></i> Waitlist</a>
   <a class="btn btn-block btn-success" onclick="event.preventDefault();document.getElementById('approve-form{{ $i }}').submit();" style="color:#fff;"><i class="fas fa-check-circle"></i> Approve</a>
   <a class="btn btn-block btn-danger" onclick="event.preventDefault();document.getElementById('reject-form{{ $i }}').submit();" style="color:#fff;"><i class="fas fa-times-circle"></i> Reject</a>
          <form id="wait-form{{ $i }}" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $item->U_Id }}">
                <input type="hidden" name="status" value="Waitlisted">
          </form>
          <form id="approve-form{{ $i }}" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $item->U_Id }}">
                <input type="hidden" name="status" value="Approved">
          </form>
          <form id="reject-form{{ $i }}" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $item->U_Id }}">
                <input type="hidden" name="status" value="Rejected">
          </form>
   @elseif($route=='waitlistedJob')
   <a class="btn btn-block btn-success" onclick="event.preventDefault();document.getElementById('approve-form{{ $i }}').submit();" style="color:#fff;"><i class="fas fa-check-circle"></i> Approve</a>
   <a class="btn btn-block btn-danger" onclick="event.preventDefault();document.getElementById('reject-form{{ $i }}').submit();" style="color:#fff;"><i class="fas fa-times-circle"></i> Reject</a>
          <form id="approve-form{{ $i }}" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $item->U_Id }}">
                <input type="hidden" name="status" value="Approved">
          </form>
          <form id="reject-form{{ $i }}" action="{{ route('statuschangeJob') }}" method="POST">
                                  @csrf
                <input type="hidden" name="u_id" value="{{ $item->U_Id }}">
                <input type="hidden" name="status" value="Rejected">
          </form>
   @endif
   </td>
   </tr>
   @php
     $i++;  
   @endphp
@endforeach
@endif
</tbody>
</table>
</div>
</div>
</div>
@endsection