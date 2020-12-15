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
                <p>Please note that this is the list of the companies waiting for approval. Click on the approve button to approve the company and to reject the company click on the reject button.</p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pending Company Approvals</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Operation</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Operation</th>
                    </tr>
                  </tfoot>
                  <tbody>
@foreach ($users as $item)
   <tr>
   <td>{{$item->id}}</td>
   <td>{{$item->name}}</td>
   <td>{{$item->email}}</td>
   <td><form method="POST" action="{{ route('companyapprove') }}">@csrf<input type="hidden" name="id" value="{{ $item->id }}"><input type="hidden" name="email" value="{{ $item->email }}"><button class="btn btn-success btn-block"><i class="fas fa-check-circle"></i> Approve</button></form><br>
    <form method="POST" action="{{ route('companyreject') }}">@csrf<input type="hidden" name="id" value="{{ $item->id }}"><input type="hidden" name="email" value="{{ $item->email }}"><button class="btn btn-google btn-block"><i class="fas fa-times-circle"></i> Reject</button></form></td>
   </tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection