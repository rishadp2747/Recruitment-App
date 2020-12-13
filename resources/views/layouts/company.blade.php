@auth
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="<?php echo URL::asset('img/fav1.png'); ?>"/>

  <title>Company Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo URL::asset('vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo URL::asset('css/sb-admin-2.css'); ?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo URL::asset('vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-users"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Recruitments App</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      @php
        $route = Route::currentRouteName();  
      @endphp
      
      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='home'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='studentadd'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('studentadd') }}">
          <i class="fas fa-user-plus"></i>
            <span>Add Student</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='studentdelete'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('studentdelete') }}">
          <i class="fas fa-user-times"></i>
            <span>Delete Student</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='addJob'){{ 'active' }} @endif">
      <a class="nav-link" href="{{ route('addJob') }}">
          <i class="fas fa-plus-square"></i>
          <span>Add Job</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='viewJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('viewJob') }}">
          <i class="fas fa-eye"></i>
          <span>View Job</span></a> 
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='updateJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('updateJob') }}">
          <i class="fas fa-pencil-alt"></i>
          <span>Update Job</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='deleteJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('deleteJob') }}">
          <i class="fas fa-trash-alt"></i>
          <span>Delete Job</span></a>
      </li>
   
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='appliedCheckJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('appliedCheckJob') }}">
          <i class="fas fa-clipboard-check"></i>
          <span>Applied Applications</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='reviewingJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('reviewingJob') }}">
          <i class="fas fa-search"></i>
          <span>Reviewing Applications</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='waitlistedJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('waitlistedJob') }}">
          <i class="fas fa-clock"></i>
          <span>Waitlisted Applications</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='approvedJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('approvedJob') }}">
          <i class="fas fa-check-circle"></i>
          <span>Approved Applications</span></a>
      </li>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @if($route=='rejectedJob'){{ 'active' }} @endif">
        <a class="nav-link" href="{{ route('rejectedJob') }}">
          <i class="fas fa-times-circle"></i>
          <span>Rejected Applications</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <p class="main-dash-name"><i class="fas fa-building"></i> Company Dashboard</p>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $uname }}</span>
                <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                <i class="h4 fas fa-user-circle"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <!--<a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>-->
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
          @endif

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="color:#fff;">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo URL::asset('vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="<?php echo URL::asset('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo URL::asset('js/sb-admin-2.min.js'); ?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo URL::asset('vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo URL::asset('vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo URL::asset('js/demo/datatables-demo.js'); ?>"></script>

</body>

</html>
@endauth