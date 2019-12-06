@extends('template.style')
@section('isi')
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Main Menu
          <small>Absensi</small>
        </h1>
        <!--
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
          <li class="active">Assesment</li>
        </ol>
        -->
      </section>
      <!-- Main content -->
      <div class="container">
        <div>
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="{{Request::is('absensi','absensi/pasien')?'active':''}}">
            <a href="#pasien" aria-controls="home" role="tab" data-toggle="tab">Pasien</a>
          </li>
          <li role="presentation" class="{{Request::is('absensi/terapis')?'active':''}}">
            <a href="#terapis" aria-controls="profile" role="tab" data-toggle="tab">Terapis</a>
          </li>
          <li role="presentation" class="{{Request::is('absensi/karyawan')?'active':''}}">
            <a href="#karyawan" aria-controls="profile" role="tab" data-toggle="tab">Karyawan</a>
          </li>
        </ul>

        @include('main_menu.absensi-tab.absensi-pasien')
        @include('main_menu.absensi-tab.absensi-terapis')
        @include('main_menu.absensi-tab.absensi-karyawan')
        <!-- End Nav tabs -->

        </div>
      </div>
      <!-- /.content -->
    </div>

  @endsection
