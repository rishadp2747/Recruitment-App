@extends('layouts.company')

@section('content')
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of jobs posted</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Job Title</th>
                      <th>Salary</th>
                      <th>Job Description</th>
                      <th>Min Qualification</th>
                      <th>Age</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Job Title</th>
                      <th>Salary</th>
                      <th>Job Description</th>
                      <th>Min Qualification</th>
                      <th>Age</th>
                      <th>Created At</th>
                    </tr>
                  </tfoot>
                  <tbody>
@foreach ($jobs as $item)
   <tr>
   <td>{{$item->Job_Title}}</td>
   <td>{{$item->Salary}}</td>
   <td>{{$item->Project_Description}}</td>
   <td>{{$item->Min_Qualification}}</td>
   <td>{{$item->Min_Age}} - {{$item->Max_Age}}</td>
   <td>{{$item->created_at}}</td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection