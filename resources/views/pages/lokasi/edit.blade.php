@extends('layout.master')

@push('plugin-styles')
<style>
  #userListTable_paginate, #userListTable_filter{
    float: right !important;
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
            <h4 class="card-title">Input Lokasi</h4>
            <p class="card-description"></p>
            <form class="forms-sample" action="{{ ! isset($lokasi) ? route('lokasi_add_process') : route('lokasi_edit_process', [ 'id' => $lokasi->id ]) }}" method="POST">
              @csrf  
              <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($user) ? $user->id : '' }}">
              <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <textarea class="form-control" id="alamat" name="alamat" style="height: 100px;">{{ isset($lokasi) ? $lokasi->alamat : '' }}</textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a href="{{ route('lokasi_list') }}" class="btn btn-light">Cancel</a>
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