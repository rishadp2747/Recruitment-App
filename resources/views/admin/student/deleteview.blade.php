@extends('layouts.admin')

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
                <div class="form-group row justify-content-center red-b-white">
                  <div class="col-12">
                    <div class="row p-2 justify-content-center">
                      <p class="jobhead white"><i class="fas fa-exclamation-triangle"></i> <b>Delete All Students</b> <i class="fas fa-exclamation-triangle"></i></p>
                    </div>
                    <div class="row justify-content-center p-2">
                      <p class="white" style="text-align: center;">*Click the below button to delete all the students data at once.</p>
                    </div>
                    <div class="row justify-content-center">
                        <a class="btn btn-primary btn-user btn-block" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Delete</a>
                    </div>
                  </div>
              </div>
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
   <td><form method="POST" action="{{ route('studentdeletes') }}">@csrf<input type="hidden" name="id" value="{{ $item->id }}"><input type="hidden" name="email" value="{{ $item->Email }}"><button class="btn btn-google btn-block"><i class="fas fa-trash-alt"></i> Delete</button></form></td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
<!-- delete list Modal-->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete all students ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure do you want to delete all students at once? please keep in mind that once you click the delete button all the data including the jobs applied by the students will be deleted.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('wait-form').submit();" style="color:#fff;">Delete</a>
          <form id="wait-form" action="{{ route('studentdeletes') }}" method="POST">
                                  @csrf
                <input type="hidden" name="id" value="">
                <input type="hidden" name="email" value="all">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection