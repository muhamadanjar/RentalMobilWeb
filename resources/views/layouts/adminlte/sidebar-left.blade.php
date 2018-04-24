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
        @if(auth()->user()->isRole('superadmin') || auth()->user()->isRole('admin'))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-car"></i> <span>Mobil & Driver</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ route('backend.mobil.index') }}">
                <i class="fa fa-car"></i>
                <span>List Mobil & Saldo Driver</span>
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">4</span>
                </span>
              </a>
            </li>
            <li>
              <a href="{{ route('backend.mobil.driver') }}">
                <i class="fa fa-car"></i>
                <span>Tambah Mobil & Driver</span>
                <span class="pull-right-container">
                  <span class="fa fa-plus pull-right"></span>                  
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('backend.transaksi.index')}}"><i class="fa fa-circle-o"></i> Pemesanan</a></li>
            <li><a href="{{ route('backend.transaksi.task.index')}}"><i class="fa fa-circle-o"></i> Task</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('backend.laporan.index')}}"><i class="fa fa-circle-o"></i> Pemesanan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Pengaturan</span>
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
        @endif
        
        
        <li class="header">LABELS</li>
        <li><a href="{{route('backend.promo.index')}}"><i class="fa fa-circle-o text-red"></i> <span>Slide Promo</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>