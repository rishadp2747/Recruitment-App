@extends('layouts.company')

@section('content')
@php
   $i = 0; 
@endphp
@php

$path = public_path('storage/uploads/company/students/approved'.str_replace(' ', '', strtolower($uname)).'.csv');
$path_url = url('storage/uploads/company/students/approved'.str_replace(' ', '', strtolower($uname)).'.csv');

if(file_exists($path)){
   File::delete($path);
}
if(isset($applied)){
$ex = (array_merge($applied,$stud_del));
$fp = fopen($path, 'w');
foreach ($ex as $fields) { 
    fputcsv($fp, $fields); 
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
          @php
           $route = Route::currentRouteName();  
          @endphp
          @if ($route=='approvedJob' && isset($applied))
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
   <td><a href="/dashboard/jobs/company/applied/{{ $item->U_Id }}" class="btn btn-facebook btn-block"><i class="fas fa-info-circle"></i> Know More</a></td>
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