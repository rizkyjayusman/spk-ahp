@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" src="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">

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
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">User Management</h4>
            <p class="card-description">
              @if(Auth::user()->role_id == 1)
                <a href="{{ route('user_add') }}" class="btn btn-primary btn-rounded btn-sm">Tambah User</a>
              @endif 
            </p>
            <div class="row">
              <div class="filter">
                <h6><b>Filter</b></h6>
                <div class="row">
                  <div class="form-group col-md-2">
                    <select id="role_id_filter" class="js-example-basic-single w-100">
                      <option value="" selected>Role</option>
                      <option value="1">Admin</option>
                      <option value="0">User</option>
                    </select>
                  </div>
                </div>
                <a href="#" name="filter" id="filter" class="btn btn-success btn-rounded btn-sm">Search</a> 
                <a href="#" name="refresh" id="refresh" class="btn btn-light">Reset</a>
              </div>
              <div class="table-responsive">
                <table class="table" id="userListTable">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Created Date</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmModal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
          <div class="modal-body">
              Are you sure?
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="removeUserBtn" type="submit" class="btn btn-primary">Delete</button>
          </div>
      </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

  function initFilter()
    {
        $('#inputCouponCode').val('');
        $('#role_id_filter').val('').trigger('change');

    }

    function load_data() {
      var table = $('#userListTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        ajax: {
          url:"/api/users",
          type: "POST",
          data: {
            'role_id': $('#role_id_filter').val(),
          }
        },
        columns: [
            {data: 'email', name: 'email', orderable: false, searchable: false},
            {data: 'name', name: 'name', orderable: false, searchable: false},
            {data: 'created_at_formatted', name: 'created_at_formatted', orderable: false, searchable: false },
            {data: 'role_id', name: 'role_id', orderable: false, searchable: false,
              render: function (data, type, full, meta) {
                if(data == 1) {
                  return '<label class="badge badge-danger"> Admin </label>';
                } else {
                  return '<label class="badge badge-warning"> User </label>';
                }
              } },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
      });
    }

  $('document').ready( function () {
    initFilter();
    load_data();

      var deleteUserUrl;

      $(document).on('click', '.remove-user-btn', function() {
          deleteUserUrl = $(this).data('url')
          $('#confirmModal').modal('show')
      })

      $('#filter').click(function(){
        $('#userListTable').DataTable().destroy();
        load_data();
    });

      $('#removeUserBtn').click(function(e) {
        $.ajax({
          type: "POST",
          url: deleteUserUrl,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
              $('#confirmModal').modal('hide');
              $('#userListTable').DataTable().destroy();
              load_data();
          },
          error: function(data){}
          });
      });

      $('#refresh').click(function(){
        $('#userListTable').DataTable().destroy();
        initFilter();
        load_data();
      });

  } );
</script>

@endpush