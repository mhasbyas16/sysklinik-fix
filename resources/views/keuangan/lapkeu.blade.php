@extends('template.style')
@section('isi')

@include('sweet::alert')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Keuangan
        <small>Laporan Keuangan</small>
      </h1>
      <!--
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Main Menu</a></li>
        <li class="active">Assesment</li>
      </ol>
      -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-solid">


                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-7 col-md-12 text-left">
                            <div class="form-group">
                              <label class="col-sm-12"><h3>Laporan Keuangan 
                                @if (isset($bulan) && isset($tahun))
                                  
                                  {{ $b.' '.$tahun}}
                                @else
                                  Pilih Bulan dan Tahun
                                @endif
                            </h3><hr></label>
                            </div>
                        </div>
                      </div>
                  

                    <div class="col-xs-7 col-md-12 text-center">
                      <form action="{{ url('/laporan_keuangan') }}" method="post">
                        @csrf
                          <div class="form-group">
                            <label class="col-sm-1 control-label" style="text-align: left; padding-left: 10pt">Tanggal</label>

                            <div class="col-sm-3">
                              <?php
                                if (isset($bulan)){
                              ?>
                                  {!! Form::selectMonth('month', $bulan, ['class' => 'form-control']) !!}
                              <?php
                                }else{
                              ?>
                                {!! Form::selectMonth('month', null, ['class' => 'form-control']) !!}
                              <?php
                                }
                              ?>
                              
                              
                            </div>
                            <div class="col-sm-3">
                              <?php
                                if (isset($tahun)){
                              ?>
                                {!! Form::selectYear('year', 2019, now()->year, $tahun, ['class' => 'form-control']) !!}
                              <?php
                                }else{
                              ?>
                                {!! Form::selectYear('year', 2019, now()->year, null, ['class' => 'form-control']) !!}
                              <?php
                                }
                              ?>
                            </div>
                            <div class="col-sm-1">
                              <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                          </div>
                      </form>
                    </div>

                  @if (isset($data))
                    @foreach ($data as $d)
                      @if (count($data) < 1)
                        <div class="row text-center" style="padding-top:100px;">
                          <div class="col-xs-7 col-md-10 col-md-offset-1 alert alert-warning">
                              <span style="font-weight: bold">Tidak ada data transaksi.</span>
                          </div>
                        </div>
                      @else
                        <form>
                          <div class="col-md-12">
                            <div class="row">
                            <div class="col-xs-7 col-md-6 text-center">
                              <div class="col-xs-7 col-md-12 text-center">
                               <br>
                              </div>
                              <div class="col-xs-7 col-md-12 text-center">
                                <br>
                              </div>
                              <div class="form-group">
                                <h4 class="col-sm-5" style="text-align: left; padding-left: 20px">Pemasukan</h4>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Saldo</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->saldo_awal,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Billing</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->billing,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Uang Pangkal</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->uang_pangkal,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Assessment</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->assesment,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8" style="border-bottom:solid black 2px;">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">BB/Cashbon</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->piutang,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding:10px 0px 0px 0px; margin: 0px 20px">
                            <div class="col-xs-7 col-md-12">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left;">Total Pemasukan</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-2">
                                    {{ number_format($d->total_pemasukan,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-7 col-md-6 text-center">
                              <div class="col-xs-7 col-md-12 text-center">
                               <br>
                              </div>
                              <div class="col-xs-7 col-md-12 text-center">
                                <br>
                              </div>
                              <div class="form-group">
                                <h4 class="col-sm-5 control-label" style="text-align: left; padding-left: 20px;">Pengeluaran</h4>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8" style="text-align: left; padding-left: 20px">Listrik</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->listrik,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>

                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Telkom</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->telkom,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Pajak</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->pajak,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Insentif Terapis</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->insentif_terapis,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Fee</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->fee,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Bonus</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->bonus,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding-bottom:10px; margin-left:20px">
                            <div class="col-xs-7 col-md-8" style="border-bottom:solid black 2px;">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left; padding-left: 20px">Lainnya</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-3">
                                    {{ number_format($d->lainnya,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding:10px 0px 10px 0px; margin: 0px 20px">
                            <div class="col-xs-7 col-md-12" style="border-bottom:double black; padding-bottom: 10px">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left;">Total Pengeluaran</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-2">
                                    {{ number_format($d->total_pengeluaran,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div class="row" style="padding:10px 0px 50px 0px; margin:0px 20px">
                            <div class="col-xs-7 col-md-12">
                                <div class="form-group">
                                  <label class="col-sm-8 control-label" style="text-align: left;">Saldo Akhir</label>
                                  <div class="col-sm-1 text-left">
                                    Rp.
                                  </div>
                                  <div class="text-right col-sm-2">
                                    {{ number_format($d->saldo_akhir,0) }}
                                  </div>
                                </div>
                            </div>
                          </div>
                          </div>


                          <div class="box-body" style="margin: 0px 20px">
                            <div class="row">
                              <div class="col-xs-7 col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                      <a class="col-md-12 btn btn-primary text-center" href="{{ url('/print/laporan/'.$d->id_saldo) }}" target="_Blank">
                                        Export Excel
                                      </a>
                                    </div>
                                  </div>
                                  <br>
                                  <br>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      @endif
                      
                    @endforeach
                  @else
                    <div class="row text-center" style="padding-top:100px;">
                      <div class="col-xs-7 col-md-10 col-md-offset-1 alert alert-warning">
                          <span style="font-weight: bold">Pilih bulan dan tahun terlebih dahulu.</span>
                      </div>
                    </div>
                  @endif
              </div>

                   
          </div>
        </div>
      </div>
      
    </section>
    <!-- /.content -->
  </div>

@endsection
