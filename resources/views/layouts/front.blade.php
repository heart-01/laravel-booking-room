<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/front/mystyle.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <!-- Other CSS -->
  <link rel="stylesheet" href="{{ asset('css/front/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/front/login.css') }}">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
  <!--Selected-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  <!--Fancybox-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" />
  <!--Date Range Picker-->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- Sweet Alert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Recaptcha2 -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!--Date Picker Tempusdominus-->
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/th.min.js" integrity="sha512-IiSJKJyOVydT9/jfVcnpg7PIUM41Be6YzR5bTiAEAEQxTVtnUhbhiSNtgGXmOTFoxYpYs+LdxWlELOK7iRVVBg==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.js" ></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.css" />
  <link rel="stylesheet" href="{{ asset('css/front/books/icon-b3.css') }}"> --}}

  <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="kanin">
  <!-- Menu -->
  <div class="container-fluid" style="margin-bottom: 61px;">
    <div class="row">
      <div class="col col-sm-12 col-md-12">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #ffffff;">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menuMobile" aria-controls="menuMobile" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>  
          <!-- Menu Mobile -->
          <div class="collapse navbar-collapse" id="menuMobile">
            <ul class="navbar-nav mr-auto text-center">              
              <li class="nav-item mt-1 mb-1 d-block d-xl-none d-lg-none nav-home">
                <a href="{{ route('welcome') }}" class="nav-link @if(Request::is('welcome')|Request::is('/')|Request::is('home')) active-menu2 @endif">
                  <i class="fas fa-home"></i> หน้าแรก
                </a>
              </li>
              <li class="nav-item mb-1 d-block d-xl-none d-lg-none nav-booking">
                <a href="{{ route('book') }}" class="nav-link @if(Request::is('book')) active-menu2 @endif">
                  <i class="far fa-calendar-alt"></i> จองห้อง
                </a>
              </li>
              <li class="nav-item mb-1 d-block d-xl-none d-lg-none nav-contact">
                <a href="{{ route('contact') }}" class="nav-link @if(Request::is('contact')) active-menu2 @endif">
                  <i class="far fa-envelope"></i> ข้อมูลติดต่อ
                </a>
              </li>
              <div class="dropdown-divider"></div>
              <li class="nav-item mb-1 d-block d-xl-none d-lg-none nav-comment">
                <a href="{{ route('history') }}" class="nav-link @if(Request::is('history')) active-menu2 @endif">
                  <i class="fas fa-info-circle"></i> ประวัติการจองห้อง
                </a>
              </li>
              <li class="nav-item mb-1 d-block d-xl-none d-lg-none nav-comment">
                <a href="{{ route('assessment') }}" class="nav-link @if(Request::is('assessment')) active-menu2 @endif">
                  <i class="far fa-file-alt"></i> ประเมินความพึงพอใจ
                </a>
              </li>
              @if (Session::get('status')=='2') 
                <li class="nav-item mb-1 d-block d-xl-none d-lg-none nav-dashboard">
                  <a href="{{ route('dashboard') }}" class="nav-link @if(Request::is('dashboard')) active-menu2 @endif" target="_blank">
                    <i class="fas fa-user-cog"></i> Admin Dashboard
                  </a>
                </li>
              @endif
            </ul>
            <!-- LOGO -->
            <div class="collapse navbar-collapse">
              <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('images/front/logo_kmutnb.png') }}" width="40" height="40" alt="">
              </a>
              <ul class="navbar-nav mr-auto">                
                <!-- Top Menu -->
                <a href="{{ route('welcome') }}" class="nav-link d-none d-sm-none d-md-none d-lg-block mr-3 @if(Request::is('welcome')|Request::is('/')|Request::is('home')) active-menu @endif" style="color: rgba(0, 0, 0, 0.76);">
                  <i class="fas fa-home"></i> หน้าแรก
                </a>
                <a href="{{ route('book') }}" class="nav-link d-none d-sm-none d-md-none d-lg-block mr-3 @if(Request::is('book')) active-menu @endif" style="color: rgba(0, 0, 0, 0.76);">
                  <i class="far fa-calendar-alt"></i> จองห้อง
                </a>
                <a href="{{ route('contact') }}" class="nav-link d-none d-sm-none d-md-none d-lg-block mr-3 @if(Request::is('contact')) active-menu @endif" style="color: rgba(0, 0, 0, 0.76);">
                  <i class="far fa-envelope"></i> ข้อมูลติดต่อ
                </a>
              </ul>              
            </div>          
            
            <div class="text-right">     
              @if (Session::get('status')) 
              <!-- User Menu -->
              <li class="dropdown user user-menu open d-none d-sm-none d-md-none d-lg-block">
                <a href="#" class="dropdown-toggle text-dark nav-link" style="display:block;" data-toggle="dropdown" aria-expanded="true">
                  {{-- <img src="{{ url('/dashboard/dist/img/admin.png') }}" width="30px" alt="User Image"> --}}
                  <i class="far fa-user mr-1"></i> {{Session::get('fullname')}}
                </a>
                <ul class="dropdown-menu kanin" style="@if (Session::get('status')=='1') width: 200px !important;height: 160px !important; @elseif (Session::get('status')=='2') width: 200px !important;height: 220px !important; @endif">
                    <!-- Menu Body -->
                    <li class="user-body">
                      <div class="col-xs-4 text-center">
                        <a href="{{ route('history') }}" class="nav-link d-none d-sm-none d-md-none d-lg-block text-dark">
                          <i class="fas fa-info-circle"></i> ประวัติการจองห้อง
                        </a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="{{ route('assessment') }}" class="nav-link d-none d-sm-none d-md-none d-lg-block text-dark">
                          <i class="far fa-file-alt"></i> ประเมินความพึงพอใจ
                        </a>
                      </div>
                      <div class="dropdown-divider"></div>
                      @if (Session::get('status')=='2')
                      <div class="col-xs-4 text-center">
                        <a href="{{ route('dashboard') }}" class="nav-link d-none d-sm-none d-md-none d-lg-block text-dark" target="_blank">
                          <i class="fas fa-user-cog"></i> Admin Dashboard
                        </a>
                      </div>
                      <div class="dropdown-divider"></div>
                      @endif
                    </li>
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

                <!--Mobile-->
                <a class="btn btn-danger btn-sm rounded-pill mt-1 d-block d-sm-block d-md-block d-lg-none logout" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              @else
                <!--Desktop-->
                <button type="button" class="btn btn-success btn-sm rounded-pill mt-1 d-none d-sm-none d-md-none d-lg-block" data-toggle="modal" data-target="#loginModal">
                  <i class="fas fa-unlock mr-1"></i> เข้าสู่ระบบ
                </button>
                <!--Mobile-->
                <a class="btn btn-success btn-sm rounded-pill mt-1 d-block d-sm-block d-md-block d-lg-none" href="{{ route('login') }}">
                  <i class="fas fa-unlock mr-1"></i> เข้าสู่ระบบ
                </a>
              @endif
            </div>            
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!--end  menu -->

  <!--start  image slide -->
  @section('sidebar')
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/front/pichead.png') }}" class="d-block w-100" height="400" alt="pichead">
      </div>
    </div>
  </div>
  @show
  <!--end  image slide  -->

  <!--start  main -->
  <div class="container">
    <div class="row">
      <!--start menu left -->
      {{-- <div class="col-sm-3 col-md-3 d-none d-sm-block menu-custom">
        <br>
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action font-weight-bold active-menu">
            <i class="fas fa-list"></i> หมวดหมู่
          </a>
          <a href="{{ route('welcome') }}" class="list-group-item list-group-item-action list-home @if(Request::is('welcome')|Request::is('/')) active @endif">
            <i class="fas fa-home"></i> หน้าแรก
          </a>
          <a href="{{ route('book') }}" class="list-group-item list-group-item-action list-booking @if(Request::is('book')) active @endif">
            <i class="far fa-calendar-alt"></i> จองห้อง
          </a>
          <a href="#" class="list-group-item list-group-item-action list-details">
            <i class="fas fa-info-circle"></i> ข้อมูลห้อง
          </a>
          <a href="#" class="list-group-item list-group-item-action list-comment">
            <i class="far fa-comments"></i> แจ้งข้อคิดเห็น
          </a>
          <a href="#" class="list-group-item list-group-item-action list-contact">
            <i class="far fa-envelope"></i> ข้อมูลติดต่อ
          </a>
          @if (Session::get('status')=='2') 
            <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action list-dashboard @if(Request::is('dashboard')) active @endif">
              <i class="fas fa-user-cog"></i> Admin Dashboard
            </a>
          @endif
        </div>
      </div> --}}
      <!--end menu left -->
      <!--start content -->
      <div class="col-12 mt-4">
        @yield('content')
      </div>
      <!--end content -->
    </div>
  </div>
  <!--end  main  -->

  <!--start  footer -->
  @section('footer')
  <div class="card-header text-right" style="background-color: #004085;margin-top: 120px;color: white;">
    CopyRight © {{ date("Y") }}
  </div>
  @show
  <!--end  footer -->
</body>

</html>

<!-- Modal Login-->
<div class="modal fade in" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="form-title text-center">
        <h4>เข้าสู่ระบบ</h4>
      </div>
      <form method="POST" action="{{ route('login') }}">
      @csrf
        <div class="modal-body">
          <div class="d-flex flex-column text-left mt-3">
            <div class="form-group">
              <?= Form::label('Username', '* Username'); ?>
              <input class="form-control form-control-custom @error('Username') is-invalid @enderror" name="Username" value="{{ old('Username') }}" required autocomplete="Username" placeholder="Your ICIT Account...">
            </div>
            <div class="form-group">
              <?= Form::label('password', '* Password'); ?>
              <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Your password...">
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <button type="submit" class="btn btn-block rounded-pill" style="background-color: #260176;color:white">
            <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
          </button>
        </div><br>
      </form>
      <div class="modal-footer d-flex justify-content-center">
        E-Room System by ICIT Account. 
      </div>
    </div>
  </div>
</div>