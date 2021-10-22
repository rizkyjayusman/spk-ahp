@extends('layout.master')

@push('plugin-styles')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"> -->
<style>

  .error-durasi {
    color: red;
    display: none;
  }

  .error-durasi.show {
    display: block;
  }

</style>
@endpush

@section('content')
<div class="main-panel">        
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Input Histori</h4>
            <p class="card-description"></p>
            <form class="forms-sample" action="{{ ! isset($histori_gangguan) ? route('histori_add_process') : route('histori_edit_process', [ 'id' => $histori_gangguan->id ]) }}" method="POST">
              @csrf  
              <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($histori_gangguan) ? $histori_gangguan->id : '' }}">
              <div class="form-group row">
                <label for="lokasi_id" class="col-sm-3 col-form-label"> Lokasi </label>
                <div class="col-sm-9">
                  <select name="lokasi_id" id="lokasi_id" class="js-example-basic-single w-100 {{ $errors->has('lokasi_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected> Lokasi </option>
                    @foreach($lokasi as $l)
                        <option value="{{$l['id']}}" 
                        @if(isset($histori_gangguan)) 
                          @if($histori_gangguan->lokasi_id == $l['id']) 
                            {{ 'selected' }} 
                          @endif 
                        @elseif(old('lokasi_id') == $l['id'])
                          {{ 'selected' }} 
                        @endif>{{$l['alamat']}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('lokasi_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('lokasi_id') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
                <div class="form-group input-daterange filter-daterange">
                  <div class="row">
                    <label for="awal_gangguan" class="col-sm-3 col-form-label">Awal Gangguan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control {{ $errors->has('awal_gangguan') ? ' is-invalid' : '' }}" id="awal_gangguan" name="awal_gangguan" autocomplete="off" placeholder='Awal Gangguan'  value="{{ isset($histori_gangguan) ? $histori_gangguan->awal_gangguan : old('awal_gangguan') }}" required>
                      <p style="font-size: 12px; color: red;">* format date: YYYY-mm-dd H:i:s; ex: 2021-01-01 01:10:00</p>
                      @if($errors->has('awal_gangguan'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('awal_gangguan') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
              </div>
              <div class="form-group  input-daterange filter-daterange">
                <div class="row">
                  <label for="akhir_gangguan" class="col-sm-3 col-form-label">Akhir Gangguan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control {{ $errors->has('akhir_gangguan') ? ' is-invalid' : '' }}" id="akhir_gangguan" name="akhir_gangguan" autocomplete="off" placeholder="Akhir Gangguan" value="{{ isset($histori_gangguan) ? $histori_gangguan->akhir_gangguan : old('akhir_gangguan') }}" required>
                    <p style="font-size: 12px; color: red;">* format date: YYYY-mm-dd H:i:s; ex: 2021-01-01 01:10:00</p>
                    @if($errors->has('akhir_gangguan'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('akhir_gangguan') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="durasi_gangguan" class="col-sm-3 col-form-label">Durasi Gangguan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control {{ $errors->has('durasi_gangguan') ? ' is-invalid' : '' }}" id="durasi_gangguan" name="durasi_gangguan" placeholder="Durasi Gangguan" value="{{ isset($histori_gangguan) ? $histori_gangguan->durasi_gangguan : old('durasi_gangguan') }}" disabled required>
                  <div>
                    <a href="#" id="hitungButton" style="margin-top: 15px;" class="btn btn-rounded btn-primary">Hitung</a>
                  </div>
                  @if($errors->has('durasi_gangguan'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('durasi_gangguan') }}</strong>
                    </span>
                  @endif

                  <span class="error-durasi">
                    <strong>Invalid Awal Gangguan or Akhir Gangguan Date</strong>
                  </span>

                </div>
              </div>
              <div class="form-group row">
                <label for="kategori_gangguan_id" class="col-sm-3 col-form-label"> Kategori Gangguan </label>
                <div class="col-sm-9">
                  <select name="kategori_gangguan_id" id="kategori_gangguan_id" class="js-example-basic-single w-100 {{ $errors->has('kategori_gangguan_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected> Kategori Gangguan </option>
                    @foreach($kategori_gangguan as $kategori)
                        <option value="{{$kategori['id']}}" 
                        @if(isset($histori_gangguan)) 
                          @if($histori_gangguan->kategori_gangguan_id == $kategori['id']) selected @endif 
                        @elseif(old('kategori_gangguan_id') == $kategori['id']) selected @endif >{{$kategori['title']}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('kategori_gangguan_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('kategori_gangguan_id') }}</strong>
                    </span>
                  @endif
               </div>
              </div>
              <div class="form-group row">
                <label for="hasil_klasifikasi_id" class="col-sm-3 col-form-label"> Hasil Klasifikasi </label>
                <div class="col-sm-9">
                  <select name="hasil_klasifikasi_id" id="hasil_klasifikasi_id" class="js-example-basic-single w-100 {{ $errors->has('hasil_klasifikasi_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected > Hasil Klasifikasi </option>
                    <option value="1"
                      @if(isset($histori_gangguan)) 
                        @if($histori_gangguan->hasil_klasifikasi_id == 1) selected @endif
                        @elseif(old('hasil_klasifikasi_id') == 1) selected' @endif > Dihitung Menit Gangguan </option>
                    <option value="0"  
                      @if(isset($histori_gangguan)) 
                        @if($histori_gangguan->hasil_klasifikasi_id == 0) selected @endif 
                      @elseif(old('hasil_klasifikasi_id')) @if(old('hasil_klasifikasi_id') == 0) selected @endif @endif > Tidak Dihitung Menit Gangguan </option>
                  </select>
                  @if($errors->has('hasil_klasifikasi_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('hasil_klasifikasi_id') }}</strong>
                    </span>
                  @endif
               </div>
              </div>
              <div class="form-group row">
                <label for="konklusi_id" class="col-sm-3 col-form-label"> Action </label>
                <div class="col-sm-9">
                  <select name="konklusi_id" id="konklusi_id" class="js-example-basic-single w-100 {{ $errors->has('konklusi_id') ? ' is-invalid' : '' }}" required>
                    <option value="" selected> Action </option>
                    @foreach($konklusi as $k)
                        <option value="{{$k['id']}}" 
                          @if(isset($histori_gangguan)) 
                            @if($histori_gangguan->konklusi_id == $k['id'])  selected @endif 
                          @elseif(old('konklusi_id') == $k['id']) selected @endif >{{$k['title']}}</option>
                    @endforeach
                  </select>
                  @if($errors->has('konklusi_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('konklusi_id') }}</strong>
                    </span>
                  @endif
               </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a href="{{ route('histori_gangguan_list') }}" class="btn btn-light">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
</div>
<!-- main-panel ends -->
@endsection

@push('plugin-scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->
@endpush

@push('custom-scripts')
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#hitungButton').click(function() {
      $('#durasi_gangguan').val(0);
      $('.error-durasi').removeClass('show');
      let startDate = Date.parse($('#awal_gangguan').val());
      let endDate = Date.parse($('#akhir_gangguan').val());
      if(isNaN(startDate) || isNaN(endDate)) {
        $('.error-durasi').addClass('show');
      } else {
        let dif = endDate - startDate;
        dif = Math.round((dif / 1000) / 60);
        $('#durasi_gangguan').val(dif);
      }
    });

    // $('.filter-daterange').datepicker({
    //   todayBtn:'linked',
    //   format:'yyyy-mm-dd 00:00:00',
    //   autoclose:true
    // });

});
</script>
@endpush