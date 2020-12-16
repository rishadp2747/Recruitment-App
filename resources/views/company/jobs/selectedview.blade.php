@extends('layouts.company')

@section('content')
@php
   $i = 0; 
@endphp
@php

$path = public_path('storage/uploads/company/students/selection'.str_replace(' ', '', strtolower($uname)).'.csv');
$path_url = url('storage/uploads/company/students/selection'.str_replace(' ', '', strtolower($uname)).'.csv');

if(file_exists($path)){
   File::delete($path);
}
if(isset($applied)){
$numb = 0;
$numb2 = 0;
$name_arr = array('Student Email','Job Title','Status','Age','DOB','Phone No.','Skills','Volunteership','Linkedin URL','Github URL','Bio','Gender','Asap_Skills','Aadhaar');
  foreach($applied as $ap){
    $numb = $numb +1;
    ${"new" . $numb} = array($ap->Student_Email,$ap->Job_Title,$ap->Status);
  }
  foreach($stud_det as $st){
    $numb2 = $numb2 +1;
    ${"new_2" . $numb2} = array($st->Age,$st->DOB,$st->Phoneno,$st->Skills,$st->Volunteership,$st->Linkedin,$st->Github,$st->Bio,$st->Gender, $st->Asap_Skills,$st->Aadhaar);
    ${"final" . $numb2} = (array_merge(${"new" . $numb2},${"new_2" . $numb2}));
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
          <p class="mb-4">Mark the applications as selected or not selected.</p>
          @if (isset($applied))
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
                      <th>Job Title</th>
                      <th>Student Name</th>
                      <th>Applied On</th>
                      <th>Status</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
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
   <td>{{$item->Job_Title}}</td>
   <td>{{$name[$i]->name}}</td>
   <td>{{$item->created_at}}</td>
   <td>{{$item->Status}}</td>
   <td><form method="POST" action="{{ route('statuschangeselectedJob') }}">@csrf<input type="hidden" name="u_id" value="{{ $item->U_Id }}"><input type="hidden" name="status" value="Selected"><button class="btn btn-success btn-block"><i class="fas fa-clipboard-check"></i> Selected</button></form><br>
    <form method="POST" action="{{ route('statuschangeselectedJob') }}">@csrf<input type="hidden" name="u_id" value="{{ $item->U_Id }}"><input type="hidden" name="status" value="NotSelected"><button class="btn btn-google btn-block"><i class="fas fa-times-circle"></i> Not Selected</button></form></td>
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