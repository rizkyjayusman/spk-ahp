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
                <label for="title" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-9">
                <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value="{{ isset($kategori) ? $kategori->title : '' }}" placeholder="Kategori Gangguan" required>
                @if($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                  <select name="status" id="status" class="js-example-basic-single w-100 {{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                    <option value="" 
                      @if (! isset($user)) selected @endif >Status</option>
                    <option value="1"
                      @if (isset($kategori)) 
                        @if($kategori->status == 1) selected @endif 
                      @elseif(old('status'))
                        @if(old('status') == 1) selected @endif 
                      @endif >Aktif</option>
                    <option value="0"
                      @if (isset($kategori)) 
                        @if($kategori->status == 0) selected @endif 
                      @elseif(old('status')) 
                        @if(old('status') == 0) selected @endif
                      @endif > Tidak Aktif </option>
                  </select>
                  @if($errors->has('status'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                  @endif
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