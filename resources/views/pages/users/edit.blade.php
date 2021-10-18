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
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ isset($user) ? $user->email : '' }}" {{ isset($user) ? 'disabled' : '' }}>
                </div>
              </div>
              <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ isset($user) ? $user->name : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="role" class="col-sm-3 col-form-label">Role</label>
                <div class="col-sm-9">
                  <select name="role" id="role" class="js-example-basic-single w-100"  value="{{ isset($user) ? $user->role_id : '' }}">
                    <option value="" 
                      @if (! isset($user)) selected="selected" @endif >Role</option>
                    <option value="1"
                      @if (isset($user)) @if($user->role_id == 1)
                        selected="selected"
                      @endif @endif >Admin</option>
                    <option value="0"
                      @if (isset($user)) @if($user->role_id == 0)
                          selected="selected"
                      @endif @endif >User</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <label for="confirmPassword" class="col-sm-3 col-form-label">Re Password</label>
                <div class="col-sm-9">
                  <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
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