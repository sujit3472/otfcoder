<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    @yield('plugin_css')
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css/colors/default.css') }}" id="theme" rel="stylesheet">
    @yield('header')
</head>
<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Start Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/home')}}">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            Welcome 
                            <small>{{ Auth::user()->full_name }}</small>
                            <span >
                            <!-- dark Logo text -->
                                <!-- <img src="{{ asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />     -->
                            </span>
                        </b>
                    </a>
                </div>
                <!-- ====================================================== -->
                <!-- End Logo -->
                <!-- ==================================================== -->
                <div class="navbar-collapse">
                    <!-- =================================================== -->
                    <!-- toggle and nav items -->
                    <!-- =================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item">
                            <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
                                <i class="mdi mdi-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item m-l-10"> 
                            <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i>
                            </a> 
                        </li>
                        <!-- ============================================ -->
                        <!-- Comment -->
                        <!-- ============================================ -->                        
                        <!-- ============================================== -->
                        <!-- End Comment -->
                        <!-- ============================================== -->
                        <!-- =============================================== -->
                        <!-- Messages -->
                        <!-- =========================================== -->                        
                        <!-- ============================================ -->
                        <!-- End Messages -->
                        <!-- ============================================= -->
                        <!-- ================================================= -->
                        <!-- Messages -->
                        <!-- =============================================== -->
                        <li class="nav-item dropdown mega-dropdown"> 
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                        </li>
                        <!-- ============================================== -->
                        <!-- End Messages -->
                        <!-- ================================================ -->
                    </ul>
                    <!-- ===================================================== -->
                    <!-- User profile and search -->
                    <!-- ================================================ -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ========================================= -->
                        <!-- Profile -->
                        <!-- =========================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@if(!empty(Auth::user()->full_name)) My Account @endif</a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">                                            
                                            <div class="u-text">
                                                <h4>@if(!empty(Auth::user())) {{ ucfirst(Auth::user()->full_name)}}@else"NA"@endif</h4>                     
                                                @if(Auth::user()->role_id != '1')
                                                    <a href="{{ url('profile')}}" class="btn btn-rounded 
                                                    btn-danger btn-sm">My Profile</a>
                                                @endif
                                                @if(Auth::user()->role_id == '1')
                                                    <a href="{{ url('changepassword')}}" class="btn btn-rounded btn-danger btn-sm">Change Password</a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>                                    
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-power-off"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5>@if(!empty(Auth::user()->full_name)) {{ ucfirst(Auth::user()->name)}}@else"NA"@endif</h5>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                    @include('admin.nav')
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!--=========================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ======================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    
                </div>
                <div>
                    
                </div>
            </div>
            <!-- ============================================================ -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================ -->
            <!-- ============================================================ -->
            <!-- Container fluid  -->
            <!-- ============================================================ -->
            <div class="container-fluid">
                <!-- =================================================== -->
                <!-- Start Page Content -->
                @yield('content')
                <!-- ========================================================= -->
               
                <!--========================================================= -->
                <!-- End PAge Content -->
                <!--========================================================= -->
            </div>
            <!-- ======================================================= -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ========================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> ©  </footer>
            <!-- ========================================================= -->
            <!-- End footer -->
            <!-- ========================================================= -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/jquery.slimscroll.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    
    @yield('footer')
    @stack('scripts')
</body>

</html>
