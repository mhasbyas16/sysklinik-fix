@extends('template.style')
@section('isi')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Main Menu
        <small>Register List</small>
      </h1>
    </section>

    <!-- Main content -->
    <div class="container">
      <br>
      <br>
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                    Daftar Register
                  </a>
                </li>
                <li role="presentation">
                  <a href="#assessment" aria-controls="profile" role="tab" data-toggle="tab">
                    Daftar Assesment
                  @if($countassessment>=1)
                    <span class="label label-info">{{$countassessment}}</span>
                  @endif
                  </a>
                </li>
                <li role="presentation">
                  <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                    Request Jadwal Terapis
                    @if($countrterapis>=1)
                      <span class="label label-success">{{$countrterapis}}</span>
                    @endif
                  </a>
                </li>
                <li role="presentation">
                  <a href="#izinT" aria-controls="profile" role="tab" data-toggle="tab">
                    Request Izin Terapis
                    @if($countizinrterapis>=1)
                      <span class="label label-success">{{$countizinrterapis}}</span>
                    @endif
                    </a>
                </li>
                <li role="presentation">
                  <a href="#profiles" aria-controls="profile" role="tab" data-toggle="tab">
                    Request Izin Pasien
                    @if($countrpasien>=1)
                      <span class="label label-success">{{$countrpasien}}</span>
                    @endif
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                @include('main_menu.jadwalterapi-modal.jadwal-keseluruhan')
                @include('main_menu.jadwalterapi-modal.asses-pasien')
                @include('main_menu.jadwalterapi-modal.req-jadwal-terapis')
                @include('main_menu.jadwalterapi-modal.req-izin-terapis')
                @include('main_menu.jadwalterapi-modal.req-izin-pasien')
              </div>
    </div>
  </div>
@endsection
