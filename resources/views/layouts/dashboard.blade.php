<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dashboard/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Lightbox -->
  <link href="{{ asset('css/lity.min.css') }}" rel="stylesheet">
  <!-- jQuery CDN - full version -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!-- Sweet Alert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!--Fancybox-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" />  
  <!--Selected-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <!-- Other CSS -->
  <link href="{{ asset('css/admin/main.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/datepicker/datepicker.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>    

    <!-- Right navbar links -->
    <!-- Menu Notifications -->
    <ul class="navbar-nav ml-auto">
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
    </ul>   
    <!-- Menu Admin -->
    <ul class="navbar-nav">
      <li class="dropdown user user-menu open">
        <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" aria-expanded="true">
          {{-- <img src="{{ url('/dashboard/dist/img/admin.png') }}" class="user-image" alt="User Image"> --}}
          <i class="fas fa-user-secret mr-1"></i> {{Session::get('fullname')}}
        </a>
        <ul class="dropdown-menu kanin">
            <!-- User image -->
            <li class="user-header bg-info">
                {{-- <img src="{{ url('/dashboard/dist/img/admin.png') }}" class="img-circle" alt="User Image"> --}}
                <i class="fas fa-user-secret" style="font-size: 100px;"></i>
                <p>{{Session::get('fullname')}}</p>
            </li>
            <!-- Menu Body -->
            <!--<li class="user-body">
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
            </li>-->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="row text-center">
                <div class="col-12 mt-1">
                  <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </div>
            </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-dark-warning">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('images/front/logo_icit.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
      <span class="brand-text font-weight-light kanin">จองห้องออนไลน์</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="{{ url('/dashboard/dist/img/admin.png') }}" data-lity>
            <img src="{{ url('/dashboard/dist/img/admin.png') }}" class="img-circle elevation-2" alt="User Image">
          </a>
        </div>
        <div class="info">
          <a><small><i class="fa fa-circle text-success"></i> Online</small></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column kanin" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(Request::is('Admin-Dashboard')||Request::is('Admin-Update')) active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manage Bookings
              </p>
            </a>
          </li>
          <!-- Config -->
          <li class="nav-item has-treeview @if(Request::is('semesters') || Request::is('classrooms') || Request::is('classrooms_support') || Request::is('softwares') || Request::is('assessmentForm') || str_contains(url()->current(), '/question')) menu-open @endif">
            <a href="#" class="nav-link @if(Request::is('semesters') || Request::is('classrooms') || Request::is('classrooms_support') || Request::is('softwares') || Request::is('assessmentForm') || str_contains(url()->current(), '/question')) active @endif">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Config
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('semesters') }}" class="nav-link @if(Request::is('semesters')) active @endif">
                  <i class="nav-icon fas fa-school"></i>
                  <p>ภาคการศึกษา</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('classrooms') }}" class="nav-link @if(Request::is('classrooms')) active @endif">
                  <i class="nav-icon fas fa-chalkboard-teacher"></i>
                  <p>ห้องเรียน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('classrooms_support') }}" class="nav-link @if(Request::is('classrooms_support')) active @endif">
                  <i class="fas fa-broom mr-2"></i>
                  <p>สิ่งอำนวยความสะดวก</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('softwares') }}" class="nav-link @if(Request::is('softwares')) active @endif">
                  <i class="nav-icon fas fa-laptop-code"></i>
                  <p>รายการซอฟแวร์</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('assessmentForm') }}" class="nav-link @if(Request::is('assessmentForm') || str_contains(url()->current(), '/question')) active @endif">
                  <i class="far fa-file-alt mr-3"></i>
                  <p>แบบประเมินความพึงพอใจ</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Report -->
          <li class="nav-item has-treeview @if(Request::is('report/classroom') || Request::is('report/assessment') || Request::is('report/assessment/report') || Request::is('report/classroom/report')) menu-open @endif">
            <a href="#" class="nav-link @if(Request::is('report/classroom') || Request::is('report/assessment') || Request::is('report/assessment/report') || Request::is('report/classroom/report')) active @endif">
              <i class="nav-icon far fa-folder-open"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('report.classroom') }}" class="nav-link @if(Request::is('report/classroom') || Request::is('report/classroom/report')) active @endif">
                  <i class="fas fa-file-invoice mr-3"></i>
                  <p>รีพอร์ตห้องเรียน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('report.assessment') }}" class="nav-link @if(Request::is('report/assessment') || Request::is('report/assessment/report')) active @endif">
                  <i class="fas fa-file-invoice mr-3"></i>
                  <p>แบบประเมินความพึงพอใจ</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"><br>
        @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2020</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('/dashboard/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('/dashboard/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('/dashboard/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/dashboard/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('/dashboard/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('/dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dashboard/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dashboard/dist/js/demo.js') }}"></script>
<!-- Lightbox -->
<script src="{{ asset('/js/lity.min.js') }}"></script>
<!-- Selected -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- Other JS -->
<script src="{{ asset('/js/admin/dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datepicker/datepicker.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/datepicker/datepicker-thai.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/datepicker/datepicker.th.js') }}" ></script>
</body>
</html>
