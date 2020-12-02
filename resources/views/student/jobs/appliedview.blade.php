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
          <p class="mb-4">For further details click on know more.</p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Applied Jobs</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Job Title</th>
                      <th>Applied At</th>
                      <th>Status</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Job Title</th>
                      <th>Applied At</th>
                      <th>Status</th>
                      <th>Operation</th>
                    </tr>
                  </tfoot>
                  <tbody>
@foreach ($applied as $item)
   <tr>
   <td>{{$item->Job_Title}}</td>
   <td>{{$item->created_at}}</td>
   <td>{{$item->Status}}</td>
   <td><a href="/dashboard/jobs/student/applied/{{ $item->U_Id }}" class="btn btn-facebook btn-block"><i class="fas fa-info-circle"></i> Know More</a></td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection