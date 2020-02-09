@extends('template.style')
@section('isi')

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Edit Jadwal
      </h1>
    </section>

    <section class="container-fluid">
        <div class="card">
            <br>
            <br>
            <div class="card-body">
                <form action="{{url('events/update')}}/{{$event->asses}}" 
                    method="POST" 
                    enctype="multipart/form-data" 
                    @if($event->events_count || $event->event) 
                    onsubmit="return confirm('Do you want to apply these changes to all future recurring events, too?');"
                    @endif>
                    @csrf
                    @method('POST')
                    <div class="form-group {{ $errors->has('id_pegawai') ? 'has-error' : '' }}">
                        <label for="id_pegawai">ID Pegawai*</label>
                        <input type="text" id="id_pegawai" name="id_pegawai" class="form-control" value="{{ old('id_pegawai', isset($event) ? $event->id_pegawai : '') }}" required>
                        @if($errors->has('id_pegawai'))
                            <em class="invalid-feedback">
                                {{ $errors->first('id_pegawai') }}
                            </em>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('id_asses') ? 'has-error' : '' }}">
                        <label for="id_asses">ID Asses*</label>
                        <input type="text" id="id_asses" name="id_asses" class="form-control" value="{{ old('id_asses', isset($event) ? $event->id_asses : '') }}" required>
                        @if($errors->has('id_asses'))
                            <em class="invalid-feedback">
                                {{ $errors->first('id_asses') }}
                            </em>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('id_terapipasien') ? 'has-error' : '' }}">
                        <label for="id_terapipasien">ID Terapipasien*</label>
                        <input type="text" id="id_terapipasien" name="id_terapipasien" class="form-control" value="{{ old('id_terapipasien', isset($event) ? $event->id_terapipasien : '') }}" required>
                        @if($errors->has('id_terapipasien'))
                            <em class="invalid-feedback">
                                {{ $errors->first('id_terapipasien') }}
                            </em>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : '' }}">
                        <label for="keterangan">keterangan*</label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ old('keterangan', isset($event) ? $event->keterangan : '') }}" required>
                        @if($errors->has('keterangan'))
                            <em class="invalid-feedback">
                                {{ $errors->first('keterangan') }}
                            </em>
                        @endif
                        <!-- <p class="helper-block">
                            {{ trans('cruds.event.fields.keterangan_helper') }}
                        </p> -->
                    </div>
                    <div class="form-group {{ $errors->has('tgl') ? 'has-error' : '' }}">
                        <label for="tgl">Tanggal & Jam Masuk*</label>
                        <input type="text" id="tgl" name="tgl" class="form-control datetime" value="{{ old('tgl', isset($event) ? $event->tgl : '') }}" required>
                        @if($errors->has('tgl'))
                            <em class="invalid-feedback">
                                {{ $errors->first('tgl') }}
                            </em>
                        @endif
                        <!-- <p class="helper-block">
                            {{ trans('cruds.event.fields.tgl_helper') }}
                        </p> -->
                    </div>
                    <div class="form-group {{ $errors->has('jam_masuk') ? 'has-error' : '' }}">
                        <label for="jam_masuk">Tanggal & Jam Keluar*</label>
                        <input type="text" id="jam_masuk" name="jam_masuk" class="form-control datetime" value="{{ old('jam_masuk', isset($event) ? $event->jam_masuk : '') }}" required>
                        @if($errors->has('jam_masuk'))
                            <em class="invalid-feedback">
                                {{ $errors->first('jam_masuk') }}
                            </em>
                        @endif
                        <!-- <p class="helper-block">
                            {{ trans('cruds.event.fields.jam_masuk_helper') }}
                        </p> -->
                    </div>
                    <div class="form-group {{ $errors->has('biaya') ? 'has-error' : '' }}">
                        <label for="biaya">Biaya*</label>
                        <input type="text" id="biaya" name="biaya" class="form-control" value="{{ old('biaya', isset($event) ? $event->biaya : '') }}" required>
                        @if($errors->has('biaya'))
                            <em class="invalid-feedback">
                                {{ $errors->first('biaya') }}
                            </em>
                        @endif
                    </div>
                    @if(!$event->event && !$event->events_count)
                        <div class="form-group {{ $errors->has('recurrence') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.event.fields.recurrence') }}*</label>
                            @foreach(App\Event::RECURRENCE_RADIO as $key => $label)
                                <div>
                                    <input id="recurrence_{{ $key }}" name="recurrence" type="radio" value="{{ $key }}" {{ old('recurrence', $event->recurrence) === (string)$key ? 'checked' : '' }} required>
                                    <label for="recurrence_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('recurrence'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('recurrence') }}
                                </em>
                            @endif
                        </div>
                    @else
                        <input type="hidden" name="recurrence" value="{{ $event->recurrence }}">
                    @endif
                    <div>
                        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection