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
            <h4 class="card-title">Detail Restitusi</h4>
            <p class="card-description"></p>
            <div class="form-group row">
              <p class="col-sm-3">Bulan</p>
              <div class="col-sm-9">
                @if(isset($restitusi))
                  @switch($restitusi->month)
                    @case(1)
                      <p>Januari</p>
                      @break
                    @case(2)
                      <p>Februari</p>
                      @break
                    @case(3)
                      <p>Maret</p>
                      @break
                    @case(4)
                      <p>April</p>
                      @break
                      @case(5)
                      <p>Mei</p>
                      @break
                    @case(6)
                      <p>Juni</p>
                      @break
                    @case(7)
                      <p>Juli</p>
                      @break
                    @case(8)
                      <p>Agustus</p>
                      @break
                    @case(9)
                      <p>September</p>
                      @break
                    @case(10)
                      <p>Oktober</p>
                      @break
                    @case(11)
                      <p>November</p>
                      @break
                    @case(12)
                      <p>Desember</p>
                      @break
                  @endswitch
                @endif
              </div>
            </div>

            @foreach($histori_gangguan as $key => $histori)
              <div class="form-group row">
                <p class="col-sm-3">Gangguan Ke-{{ ++$key }}</p>
                <div class="col-sm-9">
                    <p>{{ $histori->awal_gangguan  }} - {{ $histori->akhir_gangguan  }}</p>
                    <p>{{ $histori->durasi_gangguan }} Menit</p>
                </div>
              </div>
            @endforeach
            <div class="form-group row">
              <p class="col-sm-3">Total Durasi Gangguan</p>
              <div class="col-sm-9">
                  <p>{{ isset($restitusi) ? $restitusi->total_durasi : '0'  }} Menit</p>
              </div>
            </div>
            <div class="form-group row">
              <p class="col-sm-3">Pencapaian Operational</p>
              <div class="col-sm-9">
                  <p>{{ isset($restitusi) ? $restitusi->capai_kerja * 100 : '-'  }} %</p>
              </div>
            </div>
            <div class="form-group row">
              <p class="col-sm-3">Nilai Restitusi (%)</p>
              <div class="col-sm-9">
                  <p>{{ isset($restitusi) ? $restitusi->restitusi_persentase * 100 : '-'  }} %</p>
              </div>
            </div>
            <div class="form-group row">
              <p class="col-sm-3">Nilai Restitusi (Rp)</p>
              <div class="col-sm-9">
                  <p>Rp. {{ isset($restitusi) ? $restitusi->restitusi : ''  }}</p>
              </div>
            </div>
            <div class="form-group row">
              <p class="col-sm-3">Jumlah Akhir (Rp)</p>
              <div class="col-sm-9">
                  <p>Rp. {{ isset($restitusi) ? $restitusi->jumlah_akhir : ''  }}</p>
              </div>
            </div>
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