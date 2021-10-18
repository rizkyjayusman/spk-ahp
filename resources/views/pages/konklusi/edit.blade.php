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
            <h4 class="card-title">Input Konklusi</h4>
            <p class="card-description"></p>
            <form class="forms-sample" action="{{ ! isset($konklusi) ? route('konklusi_add_process') : route('konklusi_edit_process', [ 'id' => $konklusi->id ]) }}" method="POST">
              @csrf  
              <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($konklusi) ? $konklusi->id : '' }}">
              <div class="form-group row">
                <label for="title" class="col-sm-3 col-form-label">Action</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="title" name="title" placeholder="Action" value="{{ isset($konklusi) ? $konklusi->title : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" id="status" class="js-example-basic-single w-100"  value="{{ isset($konklusi) ? $konklusi->status : '' }}">
                    <option value="" 
                      @if (! isset($user)) selected="selected" @endif >Status</option>
                    <option value="1"
                      @if (isset($konklusi)) @if($konklusi->status == 1)
                        selected="selected"
                      @endif @endif >Aktif</option>
                    <option value="0"
                      @if (isset($konklusi)) @if($konklusi->status == 0)
                          selected="selected"
                      @endif @endif > Tidak Aktif </option>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a href="{{ route('konklusi_list') }}" class="btn btn-light">Cancel</a>
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