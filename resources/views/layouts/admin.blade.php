<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="icon" href=" {{ asset('images/logo-header.jpg') }} "/>

  <title>Booking_System</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href={{url("bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css" )}}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{url("bower_components/admin-lte/dist/css/adminlte.min.css" )}}>

  <link rel="stylesheet" href={{url("bower_components/admin-lte/dist/css/skins.min.css" )}}>

  <link rel="stylesheet" href={{url("roomBooking/css/app.css" )}}>

  <link rel="stylesheet" href="{{ asset('roomBooking/css/notif.css') }}">
  


  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

 

  @yield('css')

  <style>
  .centered {
  position: relative;
  top: 20vh;
  }
  .btn-label{
    position: relative;
    left:-12px;
    display:inline-block;
    padding:6px 12px;
    border:3px 0px 0px 3px;
    background:rgba(0,0,0,0.15);
  }
  .btn-labeled{
    padding-top:0px;
    padding-bottom:0px;
  }
  .fixed{
    position:fixed !important;
  }
  .border-zero{
    border-top-right-radius: 0px !important ;
    border-bottom-right-radius: 0px !important;
  }
  .inline{
    display: inline !important;
  }

  .fixed-content {
    position: fixed;
    top:72px;
    bottom: 0;
    overflow-y:scroll;
    overflow-x:hidden;
}
  </style>

  <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>



<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      @if(Auth()->user()->isSecretary())
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('user.show')}}" class="nav-link">Manage users</a>
        </li>
      @endif
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      

      <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
              <img src="{{ asset('assets/secretary.png') }}" class="ml-1 mt-n1" alt="Photo de profile"style="border-radius:50%;width:27px;height:27px">
          </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{ route('profile.index') }}">
                    Profile
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>


    </ul>
  </nav>
  <!-- /.navbar -->
</div>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 fixed">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center" style="pointer-events:none; cursor: default">
     <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">  -->
           <img src="{{ asset('images/adt6.png') }}" class="brand-text" alt="Photo de profile"style="width:195px;height:65px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex"style="justify-content: center">
        <div class="info">
          <a href="#" class="d-block " style="pointer-events:none; cursor: default; font-size:18px; transform:scaleY(1.1);font-weight:600;color:#f7f7f7">ROOM BOOKING SYSTEM</a>
        </div>
      </div>

      <div class="user-panel mt-n3 mb-3 d-flex">
          <div class="info">
            <a class="brand-text font-weight-light ml-2" style="font-size:15px;pointer-events: none;cursor: default;">Role:
              @if(Auth()->user()->isSecretary())
              Secretary 
              @else
              User 
              @endif
              </a>
            
          </div>
        </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(Auth()->user()->isSecretary())
          <li class="nav-item ">
            <a href="{{ route('home') }}" class="{{ (request()->is('room')) ? 'nav-link active' : 'nav-link'}}">
              <i class="nav-icon fas fa-door-closed"></i>
              <p>
                Rooms
              </p>
            </a>
          </li>
          @endif


          <li class="nav-item ">
            <a href="{{ route('reservation') }}" class="{{ (request()->is('reservation')) ||   (request()->is('reservation/filter'))  ? 'nav-link active' : 'nav-link'}} ">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Reservation
              </p>
            </a>
          </li>

          @if (isset($roomId))
          <li class="nav-item ">
            <a href="{{ route('calandar') }}" class="{{ (request()->is('calandar')) ||   (request()->is('calandar/room/'.$roomId))  ? 'nav-link active' : 'nav-link'}}">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Calendar
              </p>
            </a>
          </li>
          @else
          <li class="nav-item ">
              <a href="{{ route('calandar') }}" class="{{ (request()->is('calandar')) ||   (request()->is('calandar/room'))  ? 'nav-link active' : 'nav-link'}}">
                <i class="nav-icon fas fa-calendar-check"></i>
                <p>
                  Calendar
                </p>
              </a>
            </li>
          @endif
          
                      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 <!-- <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- Control sidebar content goes here 
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside> -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src={{ url("bower_components/admin-lte/plugins/jquery/jquery.min.js") }}></script>
<!-- jQuery-UI -->
<script src={{ url("bower_components/admin-lte/plugins/jquery-ui/external/jquery/jquery.js") }}></script>
<!-- Bootstrap 4 -->
<script src={{ url("bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
<!-- AdminLTE App -->
<script src={{ url("bower_components/admin-lte/dist/js/adminlte.min.js") }}></script>

<script src={{ url("bower_components/admin-lte/dist/js/pages/dashboard.js") }}></script>






@yield('js')
</body>
</html>
