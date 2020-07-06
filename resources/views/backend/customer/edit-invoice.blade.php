@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>Edit Invoice</span>
                    <small class="d-sm-block"><a href="{{ route('customers.credit') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i> Credit Customer List</a></small>
                </div>
                <div class="card-body">
                    {{-- <div class="table-responsive">
                    </div> --}}
                    <div>
                        <strong>Customer Infomation</strong><br>
                        {{ $payment['customer']['name'] }}<br>
                        {{ $payment['customer']['address'] }}<br>
                        {{ ($payment['customer']['email'])?$payment['customer']['email']:'Example@gmail.com' }}<br>
                        {{ $payment['customer']['mobile_no'] }} <br>
                        {{-- <strong>Invoice Date:</strong><br>
                          {{ date('d-M-Y',strtotime($invoice->date)) }}<br> --}}
                    </div> 
                    <h4 style="color: red;">Order Summary</h4> 
                    <form action="{{ route('customers.update.invoice',$payment->invoice_id) }}" method="POST" id="MyFrom">
                        @csrf     
                        <table style="width: 100%; margin-bottom:25px;" class="table-bordered">
                            <thead>
                                <tr style="background: red;">
                                    <th style=" color:white;text-align:center;">SL</th>
                                    <th style=" color:white;padding:5px;">Product Name</th>
                                    <th style=" color:white;padding:5px;">Quantity</th>
                                    <th style=" color:white;padding:5px;">Unit Price</th>
                                    <th style=" color:white;padding:5px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_sum = 0;
                                    $invoice_details = App\model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                                @endphp
                                @foreach ($invoice_details as $key => $details)
                                    <tr>
                                        <th style="text-align:center;">{{ $key+1 }}</th>
                                        <th style="padding:5px;">{{ $details['product']['name'] }}</th>
                                        <th style="padding:5px;">{{ $details->selling_qty }}
                                            {{ $details['product']['unit']['name'] }}</th>
                                        <th style="padding:5px;">{{ number_format($details->unit_price,2).' Tk' }}</th>
                                        <th style="padding:5px;">{{ number_format($details->selling_price,2).' Tk' }}</th>
                                    </tr>
                                @php
                                    $total_sum += $details->selling_price;
                                @endphp
                                @endforeach
                            </tbody>
                            <thead>
                                <tr style="background: red;">
                                    <th style=" color:white;text-align:center;">SL</th>
                                    <th style=" color:white;padding:5px;">Product Name</th>
                                    <th style=" color:white;padding:5px;">Quantity</th>
                                    <th style=" color:white;padding:5px;">Unit Price</th>
                                    <th style=" color:white;padding:5px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="4" style="text-align: right;padding:8px">SubTotal :</th>
                                    <th style="padding:5px;"><strong>{{ number_format($total_sum,2).' Tk' }}</strong></th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;padding:8px">Discount :</th>
                                    <th style="padding:5px;"><strong>{{ number_format($payment->discount_amount,2)." Tk" }}</strong></th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;padding:8px">Paid Amount :</th>
                                    <th style="padding:5px;"><strong>{{ number_format($payment->paid_amount,2)." Tk" }}</strong></th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;padding:8px">Due Amount :</th>
                                    <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                                    <th style="padding:5px;"><strong>{{ number_format($payment->due_amount,2)." Tk" }}</strong></th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: right;padding:8px;background: red;color:white">Grand Total :</th>
                                    <th style="padding:5px;"><strong>{{ number_format($payment->total_amount,2)." Tk" }}</strong></th>
                                </tr>
                            </tbody>
                        </table>
                        <div class='form-row'>
                            <div class="form-group col-md-3">
                                <label for="paid_status">Paid Status</label>
                                <select name="paid_status" id="paid_status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="full_paid">Full Paid</option>
                                    <option value="partial_paid">Partial Paid</option>
                                </select>
                                <input type="text" class="form-control form-control-sm mt-1 paid_amount" name="paid_amount" placeholder="Enter Paid Amount" style="display: none">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="date">Date</label>
                                <input type="text" class="form-control datepicker" name="date" value="{{ $date }}" id="date" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-success" style="margin-top: 33px;">Update Invoice</button>
                            </div>    
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </main>
	<footer class="py-4 bg-light mt-auto">
		<div class="container-fluid">
			<div class="d-flex align-items-center justify-content-between small">
				<div class="text-muted">Copyright &copy; Your Website 2019</div>
				<div>
					<a href="#">Privacy Policy</a>
					&middot;
					<a href="#">Terms &amp; Conditions</a>
				</div>
			</div>
		</div>
	</footer>
</div>
<script>
    $(document).on('change','#paid_status',function(){
        var paid_status =  $(this).val();
        if(paid_status == 'partial_paid'){
          $('.paid_amount').show();
        }else{
          $('.paid_amount').hide();
        }
      });
</script>
<script>
    $('.datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format:'yyyy-mm-dd'
    });
</script>
<script>
    $(document).ready(function () {
      $('#MyFrom').validate({
        rules: {
         paid_status: {
            required: true,
          },
          date: {
            required: true
          }
          
        },
        messages: {
        //   usertype: {
        //     required: "Please Select User Role",
        //   },
        //   name: {
        //     required: "Please Enter Name",
        //   },
        //   email: {
        //     required: "Please enter a email address",
        //     email: "Please enter a vaild email address"
        //   },
        //   password: {
        //     required: "Please Enter password",
        //     minlength: "Your password must be at least 6 characters long"
        //   },
        //   password2: {
        //     required: "Please Enter Confirm password",
        //     equalTo : "Confirm Password Does not Match"
        //   }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>
@endsection