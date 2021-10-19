@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" src="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">

<style>
  #historiGangguanListTable_paginate, #historiGangguanListTable_filter{
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
            <h4 class="card-title">Histori Gangguan</h4>
            <p class="card-description">
              @if(Auth::user()->role_id == 1)
                <a href="{{ route('histori_gangguan_add') }}" class="btn btn-primary btn-rounded btn-sm">Tambah Histori</a>
                <a href="#" id="exportButton" class="btn btn-dark btn-rounded btn-sm">Report</a> 
              @endif 
            </p>
            <div class="row">
            <div class="filter">
                <h6><b>Filter</b></h6>
                <div class="row">
                <div class="form-group input-daterange filter-daterange col-md-4">
                  <div class="row">
                        <div class="col-md-6">
                        <input type="text" class="form-control" id="from_date" name="from_date" autocomplete="off" placeholder='From date'>
                        </div>
                        <div class="col-md-6">
                        <input type="text" id="to_date" name="to_date" class="form-control" autocomplete="off" placeholder='To date'>
                        </div>
                    </div>
                </div>
                </div>
                <a href="#" name="filter" id="filter" class="btn btn-success btn-rounded btn-sm">Search</a> 
                <a href="#" name="refresh" id="refresh" class="btn btn-light">Reset</a>
              </div>
              <div class="table-responsive">
                <table class="table" id="historiGangguanListTable">
                  <thead>
                    <tr>
                      <th>Lokasi</th>
                      <th>Awal Gangguan</th>
                      <th>Berakhirnya Gangguan</th>
                      <th>Durasi Gangguan</th>
                      <th>Kategori Gangguan</th>
                      <th>Hasil Klafikasi</th>
                      <th>Action</th>
                      <th> ... </th>
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
            <h4 class="modal-title">Delete Histori</h4>
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
      let date = new Date();
      $('#to_date').val(date.toISOString().slice(0, 10));
      
      date.setDate(date.getDate() - 30);
      $('#from_date').val(date.toISOString().slice(0, 10));
    }

    function load_data() {
      var table = $('#historiGangguanListTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        ajax: {
          url:"/api/histori-gangguan",
          type: "POST",
          data: {
            'from_date': $('#from_date').val(),
            'to_date': $('#to_date').val(),
          }
        },
        columns: [
            {data: 'lokasi.alamat', name: 'alamat', orderable: false, searchable: false},
            {data: 'awal_gangguan', name: 'awal_gangguan', orderable: false, searchable: false},
            {data: 'akhir_gangguan', name: 'akhir_gangguan', orderable: false, searchable: false},
            {data: 'durasi_gangguan', name: 'durasi_gangguan', orderable: false, searchable: false},
            {data: 'kategori_gangguan.title', name: 'kategori_gangguan_title', orderable: false, searchable: false},
            {data: 'hasil_klasifikasi_id', name: 'hasil_klasifikasi_id', orderable: false, searchable: false,
              render: function (data, type, full, meta) {
                if(data == 1) {
                  return '<span> Restitusi </span>';
                } else {
                  return '<span> Tidak Dihitung Jam Gangguan </label>';
                }
              }},
            {data: 'konklusi.title', name: 'konklusi_title', orderable: false, searchable: false},
            {data: 'action_button', name: 'action_button', orderable: false, searchable: false},
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
        
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if(from_date != '' &&  to_date != '')
        {
          $('#historiGangguanListTable').DataTable().destroy();
          load_data();
        }
        else
        {
          alert('Both Date is required');
        }
       });

       $('.filter-daterange').datepicker({
        todayBtn:'linked',
        format:'yyyy-mm-dd',
        autoclose:true
      });
      $('.input-daterange__expired').datepicker({
        todayBtn:'linked',
        format:'yyyy-mm-dd',
        startDate: new Date(),
        autoclose:true
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
              $('#historiGangguanListTable').DataTable().destroy();
              load_data();
          },
          error: function(data){}
          });
      });

      $('#exportButton').click(function() {
      let str = jQuery.param( {
        to_date: $('#to_date').val(),
        from_date: $('#from_date').val(),
      } )
          window.location.href = "/api/histori-gangguan/export?" + str;
        });

      $('#refresh').click(function(){
        $('#historiGangguanListTable').DataTable().destroy();
        initFilter();
        load_data();
      });
  } );
</script>

@endpush