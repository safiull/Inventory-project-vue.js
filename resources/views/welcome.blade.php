
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

  <title>AdminLTE 3 | Starter</title>
  {{-- root css file --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .fa-folder, .fa-circle, .fa-tachometer-alt {
      color: #EE5A24;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div id="app">
    
    <div style="display: none;" v-show="$route.path === '/register' || $route.path === '/forget' || $route.path === '/' ? false:true">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                class="fas fa-th-large"></i></a>
          </li>
          <li class="nav-item">
            <router-link class="btn btn-light" to="/logout">Logout</router-link>
          </li>
        </ul>
      </nav>
    <!-- /.navbar -->
    </div>

    <div style="display: none;" v-show="$route.path === '/register' || $route.path === '/forget' || $route.path === '/' ? false:true">
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">Inventory manag.</span>
        </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item bg-info">
                  <router-link to="/pos" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      <b class="text-light">POS</b>
                    </p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/home" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </router-link>
                </li>
                {{-- menu-open class use for open menu --}}
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Employee
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/store-employee" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add emoloyee</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/all-employee" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Employee</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Supplier
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/store-supplier" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add supplier</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/all-supplier" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All suppliers</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Category
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/store-category" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Category</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/all-category" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Category</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Product
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/store-product" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add product</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/all-product" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All product</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Expense
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/store-expense" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Expense</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/all-expense" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Expense</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Salary
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="/pay-salary" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pay salary</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="/all-salary" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All salary</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Simple Link
                      <span class="right badge badge-danger">New</span>
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
          <router-view></router-view>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <div style="display: none;" v-show="$route.path === '/register' || $route.path === '/forget' || $route.path === '/' ? false:true">
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->
    </div>
  </div>

  <div style="display: none;" v-show="$route.path === '/register' || $route.path === '/forget' || $route.path === '/' ? false:true">
    <!-- Main Footer -->
    <footer class="main-footer" style="display: none;" v-show="$route.path === '/register' || $route.path === '/forget' || $route.path === '/' ? false:true">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

{{-- root js file --}}
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
