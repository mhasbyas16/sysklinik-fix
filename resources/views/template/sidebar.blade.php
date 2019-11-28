<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!--<div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>-->
    <!-- search form
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="{{Request::is('/')?'active':''}}">
          <a href="{{url('/')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
      </li>
      <li class="treeview {{Request::is('register-list','register-list/*','absensi','absensi/*','jadwal-terapi','jadwal-evaluasi','jadwal-evaluasi/*')?'active':''}}">
        <a href="#">
          <i class="glyphicon glyphicon-inbox "></i>
          <span>Main Menu</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Request::is('register-list','register-list/*')?'active':''}}">
            <a href="{{url('/register-list')}}"><i class="fa fa-circle-o"></i> Register List</a></li>
          <li class="{{Request::is('absensi','absensi/*')?'active':''}}">
            <a href="#"><i class="fa fa-circle-o"></i> Absensi</a></li>
          <li class="{{Request::is('jadwal-terapi')?'active':''}}">
            <a href="{{url('/jadwal-terapi')}}"><i class="fa fa-circle-o"></i> Jadwal Terapi</a></li>
          <li class="{{Request::is('jadwal-evaluasi','jadwal-evaluasi/*')?'active':''}}">
            <a href="{{url('/jadwal-evaluasi')}}"><i class="fa fa-circle-o"></i> Jadwal Evaluasi</a></li>
        </ul>
      </li>
      <li class="treeview {{Request::is('karyawan','karyawan/*','data-terapis','data-terapi','data-pasien')?'active':''}}">
        <a href="#">
          <i class="fa fa-th"></i>
          <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Request::is('karyawan','karyawan/*')?'active':''}}">
           <a href="{{url('/karyawan')}}"><i class="fa fa-circle-o"></i>Karyawan</a></li>
          <li class="{{Request::is('data-terapis')?'active':''}}">
           <a href="{{url('/data-terapis')}}"><i class="fa fa-circle-o"></i> Terapis</a></li>
          <li class="{{Request::is('data-terapi')?'active':''}}">
           <a href="{{url('/data-terapi')}}"><i class="fa fa-circle-o"></i> Jenis Terapi</a></li>
          <li class="{{Request::is('data-pasien')?'active':''}}">
           <a href="{{url('/data-pasien')}}"><i class="fa fa-circle-o"></i> Pasien</a></li>
        </ul>
      </li>
      <li class="{{Request::is('billing')?'active':''}}">
          <a href="{{url('/billing')}}">
            <i class="glyphicon glyphicon-list-alt"></i> <span>Billing</span>
          </a>
      </li>
      <li class="{{Request::is('rekam_medis')?'active':''}}">
          <a href="{{url('/rekam_medis')}}">
            <i class="fa fa-plus-square"></i> <span>Rekam medis</span>
          </a>
      </li>
      <li class="treeview {{Request::is('transaksi_keuangan','laporan_keuangan')?'active':''}}">
        <a href="#">
          <i class="glyphicon glyphicon-tags"></i>
          <span>Keuangan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Request::is('transaksi_keuangan')?'active':''}}">
            <a href="{{url('/transaksi_keuangan')}}"><i class="fa fa-circle-o"></i>Transaksi</a></li>
          <li class="{{Request::is('laporan_keuangan')?'active':''}}">
            <a href="{{url('/laporan_keuangan')}}"><i class="fa fa-circle-o"></i>Laporan Keuangan</a></li>
        </ul>
      </li>
      <li class="{{Request::is('payroll')?'active':''}}">
          <a href="{{url('/payroll')}}">
            <i class="fa fa-university"></i> <span>Payroll</span>
          </a>
      </li>
      <li class="treeview {{Request::is('alatterapi','transalat','persediaan')?'active':''}}">
        <a href="#">
          <i class="glyphicon glyphicon-briefcase"></i>
          <span>Alat Terapi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Request::is('alatterapi')?'active':''}}">
            <a href="{{url('/alatterapi')}}"><i class="fa fa-circle-o"></i> Alat Terapi</a></li>
          <li class="{{Request::is('transalat')?'active':''}}">
            <a href="{{url('/transalat')}}"><i class="fa fa-circle-o"></i> Transaksi</a></li>
          <li class="{{Request::is('persediaan')?'active':''}}">
            <a href="{{url('/persediaan')}}"><i class="fa fa-circle-o"></i> Persediaan</a></li>
        </ul>
      </li>
      <li class="{{Request::is('setting')?'active':''}}">
          <a href="{{url('/setting')}}">
            <i class="fa fa-wrench"></i> <span>Setting</span>
          </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
