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
            <h4 class="card-title">Input Kategori</h4>
            <p class="card-description"></p>
            <form class="forms-sample" action="{{ ! isset($kategori) ? route('kategori_add_process') : route('kategori_edit_process', [ 'id' => $kategori->id ]) }}" method="POST">
              @csrf  
              <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($kategori) ? $kategori->id : '' }}">
              <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Action</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title" placeholder="Action" value="{{ isset($kategori) ? $kategori->title : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" id="status" class="js-example-basic-single w-100"  value="{{ isset($kategori) ? $kategori->status : '' }}">
                    <option value="" 
                      @if (! isset($user)) selected="selected" @endif >Status</option>
                    <option value="1"
                      @if (isset($kategori)) @if($kategori->status == 1)
                        selected="selected"
                      @endif @endif >Aktif</option>
                    <option value="0"
                      @if (isset($kategori)) @if($kategori->status == 0)
                          selected="selected"
                      @endif @endif > Tidak Aktif </option>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a href="{{ route('kategori_gangguan_list') }}" class="btn btn-light">Cancel</a>
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