@extends('layout.master')

@push('plugin-styles')
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
                  <select name="lokasi_id" id="lokasi_id" class="js-example-basic-single w-100">
                    <option value="" selected> Lokasi </option>
                    @foreach($lokasi as $l)
                        <option value="{{$l['id']}}" 
                        @if(isset($histori_gangguan)) 
                          @if($histori_gangguan->lokasi_id == $l['id']) 
                            {{ 'selected' }} 
                          @endif 
                        @endif >{{$l['alamat']}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="awal_gangguan" class="col-sm-3 col-form-label">Awal Gangguan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="awal_gangguan" name="awal_gangguan" placeholder="Awal Gangguan" value="{{ isset($histori_gangguan) ? $histori_gangguan->awal_gangguan : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="akhir_gangguan" class="col-sm-3 col-form-label">Akhir Gangguan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="akhir_gangguan" name="akhir_gangguan" placeholder="Akhir Gangguan" value="{{ isset($histori_gangguan) ? $histori_gangguan->akhir_gangguan : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="durasi_gangguan" class="col-sm-3 col-form-label">Durasi Gangguan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="durasi_gangguan" name="durasi_gangguan" placeholder="Durasi Gangguan" value="{{ isset($histori_gangguan) ? $histori_gangguan->durasi_gangguan : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="kategori_gangguan_id" class="col-sm-3 col-form-label"> Kategori Gangguan </label>
                <div class="col-sm-9">
                  <select name="kategori_gangguan_id" id="kategori_gangguan_id" class="js-example-basic-single w-100">
                    <option value="" selected> Kategori Gangguan </option>
                    @foreach($kategori_gangguan as $kategori)
                        <option value="{{$kategori['id']}}" 
                        @if(isset($histori_gangguan)) 
                          @if($histori_gangguan->kategori_gangguan_id == $kategori['id']) 
                            {{ 'selected' }} 
                          @endif 
                        @endif >{{$kategori['title']}}</option>
                    @endforeach
                  </select>
               </div>
              </div>
              <div class="form-group row">
                <label for="hasil_klasifikasi_id" class="col-sm-3 col-form-label"> Hasil Klasifikasi </label>
                <div class="col-sm-9">
                  <select name="hasil_klasifikasi_id" id="hasil_klasifikasi_id" class="js-example-basic-single w-100">
                    <option value="" > Hasil Klasifikasi </option>
                    <option value="1"
                      @if(isset($histori_gangguan)) 
                        @if($histori_gangguan->hasil_klasifikasi_id == 1) 
                          {{'selected'}} 
                        @endif
                      @endif > Restitusi </option>
                    <option value="0"  
                      @if(isset($histori_gangguan)) 
                        @if($histori_gangguan->hasil_klasifikasi_id == 0) 
                        {{'selected'}} 
                      @endif 
                    @endif" > Tidak Dihitung Jam Gangguan </option>
                  </select>
               </div>
              </div>
              <div class="form-group row">
                <label for="konklusi_id" class="col-sm-3 col-form-label"> Action </label>
                <div class="col-sm-9">
                  <select name="konklusi_id" id="konklusi_id" class="js-example-basic-single w-100">
                    <option value="" selected> Action </option>
                    @foreach($konklusi as $k)
                        <option value="{{$k['id']}}" 
                          @if(isset($histori_gangguan)) 
                            @if($histori_gangguan->konklusi_id == $k['id']) 
                            {{'selected'}} 
                          @endif 
                        @endif" >{{$k['title']}}</option>
                    @endforeach
                  </select>
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
@endpush

@push('custom-scripts')
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
@endpush