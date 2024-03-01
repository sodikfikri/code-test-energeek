<!-- Main Sidebar Container -->
<?php
use Illuminate\Support\Facades\Auth;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      {{-- <img src="{{asset('dist')}}/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Pt Bersama Auto Mobilindo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist')}}/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link side-dashboard active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-header">MASTER DATA</li> -->
          <li class="nav-item nav-item-parent">
            <a href="#" class="nav-link nav-link-parent">
              <i class="nav-icon fas fa-solid fa-tags"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item nav-child">
                <a href="{{ route('master-mobil') }}" data-child="1" class="nav-link side-master-mobil">
                <i class="nav-icon far fa-circle"></i>
                  <p>
                    Mobil
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('bobot.index') }}" data-child="1" class="nav-link">
                  <i class="nav-icon far fa-circle"></i>
                  <p>
                    Bobot
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('ranking.index') }}" class="nav-link side-ranking">
              <i class="nav-icon fas  fa-angle-double-up"></i>
              <p>
                Ranking
              </p>
            </a>
          </li>


          <!-- <li class="nav-item" style="position: absolute; bottom: 0; height: 65px;">
            <a href="{{ route('actionlogout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <a href="{{ route('actionlogout') }}" style="width: 13%;" class="btn btn-danger btn-sign-out">Sign Out</a>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
