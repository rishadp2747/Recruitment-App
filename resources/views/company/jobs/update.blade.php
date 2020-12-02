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
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Posted Jobs</h6>
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
                      <th>Updated At</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Job Title</th>
                      <th>Salary</th>
                      <th>Job Description</th>
                      <th>Min Qualification</th>
                      <th>Updated At</th>
                      <th>Operation</th>
                    </tr>
                  </tfoot>
                  <tbody>
@foreach ($jobs as $item)
   <tr>
   <td>{{$item->Job_Title}}</td>
   <td>{{$item->Salary}}</td>
   <td>{{$item->Project_Description}}</td>
   <td>{{$item->Min_Qualification}}</td>
   <td>{{$item->updated_at}}</td>
   <td><a href="{{ route('updateJob')}}/{{ $item->Job_Id }}" class="btn btn-facebook btn-block"><i class="fas fa-pencil-alt"></i> Update</a></td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection