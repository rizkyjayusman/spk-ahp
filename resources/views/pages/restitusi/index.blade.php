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
            <h4 class="card-title">Restitusi</h4>
            <p class="card-description">
              @if(Auth::user()->role_id == 1)
                <a href="#" id="exportButton" class="btn btn-dark btn-rounded btn-sm">Report</a> 
              @endif
            </p>
            <div class="row">
            <div class="filter">
                <h6><b>Month</b></h6>
                <div class="row">
                  <div class="form-group col-md-2">
                    <select id="month_filter" class="js-example-basic-single w-100">
                      <option value="" selected>Bulan</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                </div>
                <a href="#" name="filter" id="filter" class="btn btn-success btn-rounded btn-sm">Search</a> 
                <a href="#" name="refresh" id="refresh" class="btn btn-light">Reset</a>
              </div>
              <div class="table-responsive">
                <table class="table" id="historiGangguanListTable">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lokasi</th>
                      <th>Durasi Gangguan</th>
                      <th>Pencapaian Operational</th>
                      <th>Nilai Restitusi (%)</th>
                      <th>Nilai Restitusi (Rp)</th>
                      <th>Jumlah Akhir (Rp)</th>
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
        $('#month_filter').val('').trigger('change');

    }

    function load_data() {
      var table = $('#historiGangguanListTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: false,
        ajax: {
          url:"/api/restitusi",
          type: "POST",
          data: {
            'month': $('#month_filter').val(),
          }
        },
        columns: [
            {data: 'month', name: 'month', orderable: false, searchable: false,
              render: function (data, type, full, meta) {
                let monthName = '';
                switch(data) {
                  case 1:
                    monthName = 'Januari';
                    break;
                  case 2:
                    monthName = 'Februari';
                    break;
                  case 3:
                    monthName = 'Maret';
                    break;
                  case 4:
                    monthName = 'April';
                    break;
                  case 5:
                    monthName = 'Mei';
                    break;
                  case 6:
                    monthName = 'Juni';
                    break;
                  case 7:
                    monthName = 'Juli';
                    break;
                  case 8:
                    monthName = 'Agustus';
                    break;
                  case 9:
                    monthName = 'September';
                    break;
                  case 10:
                    monthName = 'Oktober';
                    break;
                  case 11:
                    monthName = 'November';
                    break;
                  case 12:
                    monthName = 'December';
                    break;
                }
                return '<span>'+ monthName + '</span';
              } },
            {data: 'alamat', name: 'alamat', orderable: false, searchable: false},
            {data: 'total_durasi', name: 'total_durasi', orderable: false, searchable: false},
            {data: 'capai_kerja', name: 'capai_kerja', orderable: false, searchable: false},
            {data: 'restitusi_persentase', name: 'restitusi_persentase', orderable: false, searchable: false},
            {data: 'restitusi', name: 'restitusi', orderable: false, searchable: false},
            {data: 'jumlah_akhir', name: 'jumlah_akhir', orderable: false, searchable: false},
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
        $('#historiGangguanListTable').DataTable().destroy();
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
              $('#historiGangguanListTable').DataTable().destroy();
              load_data();
          },
          error: function(data){}
          });
      });

      $('#refresh').click(function(){
        $('#historiGangguanListTable').DataTable().destroy();
        initFilter();
        load_data();
      });

      $('#exportButton').click(function() {
      let str = jQuery.param( {
          month: $('#month_filter').val()
        } )
        window.location.href = "/api/restitusi/export?" + str;
      });
  } );
</script>

@endpush