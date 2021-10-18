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
            <h4 class="card-title">Input User</h4>
            <p class="card-description"></p>
            <form class="forms-sample" action="{{ ! isset($user) ? route('user_add_process') : route('user_edit_process', [ 'id' => $user->id ]) }}" method="POST">
            @csrf  
            <input type="hidden" class="form-control" id="id" name="id" value="{{ isset($user) ? $user->id : '' }}">
              <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{ isset($user) ? $user->email : old('email') }}" required {{ isset($user) ? 'disabled' : '' }}>
                  @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ isset($user) ? $user->name : old('name') }}" required>
                  @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="role" class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                  <select name="role" id="role" class="js-example-basic-single w-100" required value="{{ isset($user) ? $user->role_id : '' }}">
                    <option value="" 
                      @if (! isset($user)) selected="selected" @endif >Role</option>
                    <option value="1"
                      @if (isset($user)) @if($user->role_id == 1)
                        selected="selected"
                      @endif
                      @elseif(old('role') == 1)
                        selected="selected"
                      @endif >Admin</option>
                    <option value="0"
                      @if (isset($user)) @if($user->role_id == 0)
                          selected="selected"
                      @endif 
                      @elseif(old('role') == 0)
                        selected="selected"
                      @endif >User</option>
                  </select>
                  @if($errors->has('role'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('role') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                  @if($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="confirmPassword" class="col-sm-3 col-form-label">Re Password</label>
                <div class="col-sm-9">
                  <input type="password" name="confirm_password" class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" id="confirmPassword" placeholder="Confirm Password" required>
                  @if($errors->has('confirm_password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('confirm_password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <a href="{{ route('user_list') }}" class="btn btn-light">Cancel</a>
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