@extends('layout.master')

@push('plugin-styles')
<link rel="stylesheet" src="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" src="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

<style>
  #couponListTable_paginate, #couponListTable_filter {
    float: right !important;
  }

	#couponListTable_info {
		display: inline-table;
    margin-top: 15px;
	}

	#inputStatusSelect, .select2-selection.select2-selection--single {
		border: 1px solid #ced4da;
		height: 32px !important;
	}

</style>
@endpush

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">




	<div class="form-group">
      <h4 class="card-title">Search</h4>
      <p class="card-description"></p>
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
          <div class="form-group col-md-2">
              <input type="text" class="form-control" id="inputCouponCode" placeholder="Coupon Code">
          </div>
          <div class="form-group col-md-2">
          <select id="inputProductSelect" class="form-control" style="width: 100%">
              <option value="" selected>Product</option>
              @foreach($productList as $product)
                  <option value="{{$product['id']}}">{{$product['name']}}</option>
              @endforeach
          </select>
          </div>
          <div class="form-group col-md-2">
          <select id="inputStatusSelect" class="form-control custom-select">
              <option value="" selected>Status</option>
              <option value='1'>Active</option>
              <option value='0'>Used</option>
              <option value='2'>Expired</option>
          </select>
          </div>  
      </div>
      <div class="row">
        <div class="form-group p-3">
          <button type="button" name="filter" id="filter" class="btn btn-primary">Search</button>
          <button type="button" name="refresh" id="refresh" class="btn btn-success">Clear</button>
        </div>
      </div>
  </div>






        <div class="card-tools float-right">
            <button type="button" class="btn btn-icons btn-primary"  data-toggle="modal" data-target="#generateBulkCouponModal">
                <i class="mdi mdi-plus"></i>
            </button>
            <button type="button" id="exportButton" class="btn btn-icons btn-success"><i class="mdi mdi-download"></i></a> 
        </div>
        <h3 class="card-title">VOUCHER LIST</h3>
        <p class="card-description"></p>
        <div>
          <table class="table table-hover" id="couponListTable">
            <thead>
              <tr>
                <th> Coupon Code </th>
                <th> Product Name </th>
                <th> Status </th>
                <th> Created At </th>
                <th> Expired At </th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="generateBulkCouponModal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Coupon Generator</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- form start -->
        <form id="bulkCouponForm" action="javascript:void(0)" role="form">
            <div class="modal-body">
              <div class="form-group" id="username-input">
                <label for="product_id">Product ID</label>
                <div class="col-12">
                  <select id="productSelect" name="product_id" class="form-control" required style="width: 100%;">
                    <option value="" selected hidden>-- Choose --</option>
                    @foreach($productList as $product)
                      <option value="{{$product['id']}}">{{$product['name']}}</option>
                    @endforeach
                  </select>
                </div>
                <!-- <input type="text" class="form-control" id="product_id" name="product_id" placeholder="Enter product ID" required autocomplete="off"> -->
              </div>
              <!-- <div class="form-group">
                  <label for="prefix">Coupon Prefix</label>
                  <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Enter coupon prefix" required autocomplete="off">
              </div> -->
              <div class="form-group input-daterange input-daterange__expired">
                <label for="expired_at">Expired Date</label>
                <input type="text" class="form-control text-left" id="expired_at" name="expired_at" placeholder="Enter expired date" required autocomplete="off">
              </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="number" onkeydown="javascript: return event.keyCode === 8 ||
                event.keyCode === 46 ? true : !isNaN(Number(event.key))" class="form-control" id="size" name="size" placeholder="Enter size" min="1" max="5000" required autocomplete="off">
	    </div>

	<div id="errorMessage" class="alert alert-danger alert-dismissible d-none" style="padding: 0.5rem 0 0 1.25rem;">
                  <h6><i class="icon fas fa-ban"></i> Alert!</h6>
                  <div class="body"></div>
                </div>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="bulkCouponBtn" type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="confirmModal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete Coupon</h4>
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
<div class="modal fade" id="couponDetailModal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Coupon Usage Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
          <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">Coupon Code</label>
                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">Status</label>
                    <input type="text" class="form-control" id="coupon_status" name="coupon_status" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">Order Number</label>
                    <input type="text" class="form-control" id="coupon_order_number" name="coupon_order_number" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">User Redeem</label>
                    <input type="text" class="form-control" id="coupon_user_redeem" name="coupon_user_redeem" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">Product Name</label>
                    <input type="text" class="form-control" id="coupon_product_name" name="coupon_product_name" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="prefix">Redeem Date</label>
                    <input type="text" class="form-control" id="coupon_redeem_date" name="coupon_redeem_date" readonly>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
<!-- /.modal -->
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
    
    date.setDate(date.getDate() - 2);
    $('#from_date').val(date.toISOString().slice(0, 10));

        $('#inputCouponCode').val('');
          $('#inputProductSelect').val('').trigger('change');
          $('#inputStatusSelect').val('');

  }

  var ischecked_method = false;
  $('document').ready( function () {

	$("#size").on("input", function() {
		  var nonNumReg = /[^0-9]/g
			    $(this).val($(this).val().replace(nonNumReg, ''));
	});

    initFilter();
    load_data($('#from_date').val(), $('#to_date').val());
    
    function load_data(from_date = '', to_date = '')
    {
      var table = $('#couponListTable').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        searching: false,
        lengthChange: true,
        // lengthMenu: [[25, 100, -1], [25, 100, "All"]],
        buttons: [
          // {
          //   extend: 'csv',
          //   text: 'Export CSV',
          //   className: 'btn btn-primary float-left',
          //   filename: "coupon_list_" + new Date().getTime(),
          //   exportOptions: {
          //     modifier: {
          //       order : 'index', 
          //       page : 'all',
          //       search: 'none',
          //     },
          //     columns: [ 0, 1, 2, 3, 4 ]
          //   },
          // }
        ],
        ajax: {
          url:"/api/coupons",
          type: "POST",
	  // data:{from_date:from_date, to_date:to_date}
	            data:{
		                from_date:from_date, 
					            to_date:to_date,
						                coupon_code: $('#inputCouponCode').val(),
								            product_id: $('#inputProductSelect').val(),
									                status: $('#inputStatusSelect').val()
											          }
        },
        columns: [
          {data: 'coupon_code', orderable: false, searchable: true},
          {data: 'product.name', orderable: false, searchable: true},
    		{ data: 'status_label', orderable: false, searchable: true },
	  // {data: 'status', orderable: false, searchable: true,
          //  render: function (data, type, row) {
          //    if (data) {
          //      return 'Active';
          //    } else {
          //      return 'Inactive';
          //    }
          //  }
          // },
          {data: 'created_at', orderable: false, searchable: true},
          {data: 'expired_at', orderable: false, searchable: true},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
      });
    }

    $('#filter').click(function(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      if(from_date != '' &&  to_date != '')
      {
        $('#couponListTable').DataTable().destroy();
        load_data(from_date, to_date);
      }
      else
      {
        alert('Both Date is required');
      }
    });

    $('#exportButton').click(function() {
      let str = jQuery.param( {
        to_date: $('#to_date').val(),
		from_date: $('#from_date').val(),
		coupon_code: $('#inputCouponCode').val(),
		            product_id: $('#inputProductSelect').val(),
			                status: $('#inputStatusSelect').val()
      } )
      window.location.href = "/api/coupons/export?" + str;
    });

    $('#refresh').click(function(){
      $('#couponListTable').DataTable().destroy();
      initFilter();
      load_data($('#from_date').val(), $('#to_date').val());
    });

      $('#bulkCouponForm').submit(function(e) {
        e.preventDefault();
	
	if(!$('#errorMessage').hasClass('d-none')) {
		          $('#errorMessage').addClass('d-none');
			          }

	var formData = new FormData(this);
        $.ajax({
          type: "POST",
          url: "/api/coupons/bulk",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          beforeSend: function(){
            $("#bulkCouponBtn").prop('disabled', true);
          },
          success: (data) => {
            $('#generateBulkCouponModal').modal('hide');
            $('#productSelect').val('').trigger('change');
            this.reset();
            $('#couponListTable').DataTable().destroy();
            load_data($('#from_date').val(), $('#to_date').val());
            
            $('#bulkCouponBtn').prop('disabled', false);
        },
		// error: function(data){}
		error: function(data){
			          $('#errorMessage').removeClass('d-none');
				            let error = "<ul><li>" + data.responseJSON.message + "</li></ul>";
				            $('#errorMessage .body').html(error);
			          $('#bulkCouponBtn').prop('disabled', false);

		}
      });
      });


        
      $('[data-dismiss=modal]').on('click', function (e) {
	          $('#errorMessage').addClass('d-none');
		      $('#errorMessage .body').html('');
		    })

    $(document).on('click', '.view-detail-btn', function() {
        id = $(this).data('id');
        urlDetailCoupon = $(this).data('url');
        status = $(this).data('status');
        $.ajax({
                type:'GET',
                url: urlDetailCoupon,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#couponDetailModal').modal('show')
                    $('#coupon_order_number').val(data.invoice_id)
                    $('#coupon_redeem_date').val(data.redeem_at)
		    $('#coupon_code').val(data.coupon.coupon_code)
		    $('#coupon_status').val(data.coupon.status_label)
                    // if(!data.coupon.status){
                    //   $('#coupon_status').val("Inactive")
                    // }
                    $('#coupon_user_redeem').val(data.user.full_name)
                    $('#coupon_product_name').val(data.coupon.product.name)
                },
                error: function(data){}
            });
    })

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
              table.draw();
          },
          error: function(data){}
          });
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

    $('#generateBulkCouponModal').on('hidden.bs.modal', function () {
      $('#productSelect').val('').trigger('change');
      $(this).find('form').trigger('reset');
    })

    $('#productSelect').select2({
      width: 'style',
    });

	$('#inputProductSelect').select2({
	      width: 'style',
		          });


  } );
</script>

@endpush
