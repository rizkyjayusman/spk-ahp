@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" src="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">

<style>
  #lokasiListTable_paginate, #lokasiListTable_filter{
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
            <h4 class="card-title">Lokasi</h4>
            <p class="card-description">
              @if(Auth::user()->role_id == 1)
                <a href="{{ route('lokasi_add') }}" class="btn btn-primary btn-rounded btn-sm">Tambah Lokasi</a>
              @endif 
            </p>
            <div class="row">
              <div class="table-responsive">
                <table class="table" id="lokasiListTable">
                  <thead>
                    <tr>
                      <th>Alamat</th>
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

    function load_data() {
      var table = $('#lokasiListTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        ajax: {
          url:"/api/lokasi",
          type: "POST",
        },
        columns: [
            {data: 'alamat', name: 'alamat', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
      });
    }

  $('document').ready( function () {
    load_data();

      var deleteUserUrl;

      $(document).on('click', '.remove-user-btn', function() {
          deleteUserUrl = $(this).data('url')
          $('#confirmModal').modal('show')
      })

      $('#removeUserBtn').click(function(e) {
        $.ajax({
          type: "POST",
          url: deleteUserUrl,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {
              $('#confirmModal').modal('hide');
              $('#lokasiListTable').DataTable().destroy();
              load_data();
          },
          error: function(data){}
          });
      });
  } );
</script>

@endpush