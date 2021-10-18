@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" src="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">

<style>
  #konklusiListTable_paginate, #konklusiListTable_filter{
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
            <h4 class="card-title">Manajemen Konklusi</h4>
            <p class="card-description">
              @if(Auth::user()->role_id == 1)
                <a href="{{ route('konklusi_add') }}" class="btn btn-primary btn-rounded btn-sm">Tambah Konklusi</a>
              @endif 
            </p>
            <div class="row">
            <div class="filter">
                <h6><b>Filter</b></h6>
                <div class="row">
                  <div class="form-group col-md-2">
                    <select id="status_filter" class="js-example-basic-single w-100">
                      <option value="" selected>Status</option>
                      <option value="1">Aktif</option>
                      <option value="0">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
                <a href="#" name="filter" id="filter" class="btn btn-success btn-rounded btn-sm">Search</a> 
                <a href="#" name="refresh" id="refresh" class="btn btn-light">Reset</a>
              </div>
              <div class="table-responsive">
                <table class="table" id="konklusiListTable">
                  <thead>
                    <tr>
                      <th>Konklusi</th>
                      <th>Status</th>
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
            <h4 class="modal-title">Delete Konklusi</h4>
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
        $('#status_filter').val('').trigger('change');

    }

    function load_data() {
      var table = $('#konklusiListTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        ajax: {
          url:"/api/konklusi",
          type: "POST",
          data: {
            'status': $('#status_filter').val(),
          }
        },
        columns: [
            {data: 'title', name: 'title', orderable: false, searchable: false},
            {data: 'status', name: 'status', orderable: false, searchable: false,
              render: function (data, type, full, meta) {
                if(data == 1) {
                  return '<label class="badge badge-danger"> Aktif </label>';
                } else {
                  return '<label class="badge badge-warning"> Tidak Aktif </label>';
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
        $('#konklusiListTable').DataTable().destroy();
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
              $('#konklusiListTable').DataTable().destroy();
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