<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dreams Eye</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="icon" href="{{asset('img/ficon.jpg')}}" type="image/x-icon" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" id="content">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link ml-5" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-5">
        <router-link to="/" style="font-size: 16px; font-weight: 700;" class="nav-link">Home</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-5">
        <router-link to="/manage-order" style="font-size: 16px; font-weight: 700;" class="nav-link">Orders</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-5">
        <router-link to="/manage-contact" style="font-size: 16px; font-weight: 700;" class="nav-link">Contact</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-5">
        <router-link to="/manage-product" style="font-size: 16px; font-weight: 700;" class="nav-link">Product</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block ml-5">
        <router-link to="/manage-team" style="font-size: 16px; font-weight: 700;" class="nav-link">Team</router-link>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link btn btn-outline-secondary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
          <span style="font-size: 16px; font-weight: 700;" class="text-danger">Logout</span>
          <i style="font-size: 16px; font-weight: 700" class="far text-danger fa-user-alt-slash"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

        
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar bg-success elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
      <img src="{{ asset('uploads/logo/'.$logo->logo_image) }}"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DE</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('uploads/logo/'.$logo->logo_image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="text-white" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <router-link to="/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="text-white">
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </router-link>
            </li>

<hr>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-award"></i>
              <p class="text-white">
                Shop Logo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <!-- <li class="nav-item">
                <router-link to="/add-logo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Logo</p>
                </router-link>
              </li> -->
              <li class="nav-item">
                <router-link to="/manage-logo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Logo</p>
                </router-link>
              </li>
            </ul>
          </li>
          <br>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-user-tie"></i>
              <p class="text-white">
                Vendors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/manage-seller" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Seller</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-vendor" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Approve for Apply</p>
                </router-link>
              </li>
            </ul>
          </li>

<hr>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-cog"></i>
              <p class="text-white">
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Category</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Category</p>
                </router-link>
              </li>
            </ul>
          </li>
   <hr> 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-cog"></i>
              <p class="text-white">
                Subcategory
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-subcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Subcategory</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-subcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Subcategory</p>
                </router-link>
              </li>
            </ul>
          </li>
   <hr> 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-cog"></i>
              <p class="text-white">
                Super Subcategory
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-super-subcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Super Subcategory</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-super-subcategory" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Super Subcategory</p>
                </router-link>
              </li>
            </ul>
          </li>
   <hr>       
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-star"></i>
              <p class="text-white">
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-product" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Product</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-my-product" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">My Products</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-product" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Product</p>
                </router-link>
              </li>
            </ul>
          </li>
       <hr>   
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-copy"></i>
              <p class="text-white">
                About Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-about" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add About Info</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-about" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage About Info</p>
                </router-link>
              </li>
            </ul>
          </li>
        <hr>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-user-graduate"></i>
              <p class="text-white">
                Team Info
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-team" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Team Info</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-team" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Team Info</p>
                </router-link>
              </li>
            </ul>
          </li>
        <hr>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-street-view"></i>
              <p class="text-white">
                Models
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-model" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Model Image</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-model" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Model Image</p>
                </router-link>
              </li>
            </ul>
          </li>
        <hr>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-digital-tachograph"></i>
              <p class="text-white">
                Contact
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/add-contact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Add Contact Info</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/manage-contact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Contact Info</p>
                </router-link>
              </li>
            </ul>
          </li>
        <hr>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-briefcase"></i>
              <p class="text-white">
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/manage-order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Orders</p>
                </router-link>
                <router-link to="/view-completed-order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Completed Orders</p>
                </router-link>
                <router-link to="/view-uncompleted-order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Uncompleted Orders</p>
                </router-link>
              </li>
            </ul>
          </li>
        <hr>  
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw fa-envelope"></i>
              <p class="text-white">
                Messages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bg-warning" style="border-radius: 10px">
              <li class="nav-item">
                <router-link to="/manage-message" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-danger">Manage Messages</p>
                </router-link>
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
  <div class="content-wrapper mt-5">
      
      <router-view></router-view>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy;<a href="https://www.facebook.com/jabtakhai.shad">M.I.Saad</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
