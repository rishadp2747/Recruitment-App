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
                <p>Please note that once you click on delete button all the data associated with the student email will be erased including the jobs applied by the user and the process cannot be reversed.</p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Allowed Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Email</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Email</th>
                      <th>Operation</th>
                    </tr>
                  </tfoot>
                  <tbody>
@foreach ($users as $item)
   <tr>
   <td>{{$item->id}}</td>
   <td>{{$item->Email}}</td>
   <td><form method="POST" action="{{ route('studentdelete') }}">@csrf<input type="hidden" name="id" value="{{ $item->id }}"><input type="hidden" name="email" value="{{ $item->Email }}"><button class="btn btn-google btn-block"><i class="fas fa-trash-alt"></i> Delete</button></form></td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection