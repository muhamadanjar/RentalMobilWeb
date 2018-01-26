<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="http://placehold.it/160" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ (session('link_web') == 'dashboard')?'active':'' }}">
          <a href="{{ route('backend.dashboard.index') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ (session('link_web') == 'fasilitas')?'active':'' }}">
          <a href="{{ route('backend.dashboard.index') }}">
            <i class="fa fa-dashboard"></i> <span>Fasilitas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ (session('link_web') == 'harga')?'active':'' }}">
          <a href="{{ route('backend.dashboard.index') }}">
            <i class="fa fa-dashboard"></i> <span>Harga</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ (session('link_web') == 'tujuan')?'active':'' }}">
          <a href="{{ route('backend.dashboard.index') }}">
            <i class="fa fa-dashboard"></i> <span>Tujuan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-car"></i>
            <span>Mobil</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-config"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/setting/index')}}"><i class="fa fa-circle-o"></i> Pemesanan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-config"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('backend/setting/index')}}"><i class="fa fa-circle-o"></i> Setting</a></li>
            <li><a href="{{ route('backend.setting.profile')}}"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="{{ route('backend.log.index')}}"><i class="fa fa-circle-o"></i> Log</a></li>
            <li><a href="{{ route('backend.pengaturan.users')}}"><i class="fa fa-circle-o"></i> User</a></li>
          </ul>
        </li>
        
        <li><a href="{{ url('/') }}"><i class="fa fa-book"></i> <span>Dokumentasi</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>