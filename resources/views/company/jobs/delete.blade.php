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
                <p>Please note that once you click on delete button the job will be deleted instantly and the process cannot be reversed.</p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Delete Posted Jobs</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Job Id</th>
                      <th>Job Title</th>
                      <th>Preferred Gender</th>
                      <th>Age</th>
                      <th>Last Date</th>
                      <th>Created At</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Job Id</th>
                      <th>Job Title</th>
                      <th>Preferred Gender</th>
                      <th>Age</th>
                      <th>Last Date</th>
                      <th>Created At</th>
                      <th>Operation</th>
                    </tr>
                  </tfoot>
                  <tbody>
@foreach ($jobs as $item)
   <tr>
    <td>{{$item->Job_Id}}</td>
    <td>{{$item->Job_Title}}</td>
    <td>{{$item->gender}}</td>
    <td>{{$item->Min_Age}} - {{$item->Max_Age}}</td>
    <td>{{$item->last_date}}</td>
   <td>{{$item->created_at}}</td>
   <td><form method="POST" action="{{ route('deleteJobs') }}">@csrf<input type="hidden" name="id" value="{{ $item->Job_Id }}"><button class="btn btn-google btn-block"><i class="fas fa-trash-alt"></i> Delete</button></form></td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection