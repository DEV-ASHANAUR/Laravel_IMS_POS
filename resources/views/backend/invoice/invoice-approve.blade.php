@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Invoice</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>Invoice #{{ $invoice->invoice_no }}</span>
                    <small class="d-sm-block"><a href="{{ route('invoice.pending.list') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i> Pending Invoice List</a></small>
                </div>
                <div class="card-body">
                    @php
                        $payment = App\model\Payment::where('invoice_id',$invoice->id)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                              <strong>Shipped To:</strong><br>
                              {{ $payment['customer']['name'] }}<br>
                              {{ $payment['customer']['address'] }}<br>
                              {{ ($payment['customer']['email'])?$payment['customer']['email']:'Example@gmail.com' }}<br>
                              {{ $payment['customer']['mobile_no'] }} <br>
                              <strong>Invoice Date:</strong><br>
                                {{ date('d-M-Y',strtotime($invoice->date)) }}<br><br>
                            </address>
                        </div>
                        @if (!empty($invoice->description))
                            <div class="col-md-6 text-md-right">
                                <address>
                                <strong>Description</strong><br>
                                {{ ($invoice->description)?$invoice->description:'There is no Description in This invoice!' }}<br><br>
                                </address>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                            <form action="{{ route('approval.store',$invoice->id) }}" method="post">  
                             @csrf   
                            <table class="table table-striped border table-hover table-md">
                                <thead>
                                    <tr>
                                        <th >Sl</th>
                                        <th>Category</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Current Stock</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Unit Price</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_sum = 0;
                                    @endphp
                                    @foreach ($invoice['invoice_details'] as $key => $details)
                                        <tr>
                                            <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                            <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                            <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $details['category']['name'] }}</td>
                                            <td class="text-center">{{ $details['product']['name'] }}</td>
                                            <td class="text-center {{ ($details['product']['quantity']<10)?'text-danger':'' }}">{{ $details['product']['quantity'] }}
                                            {{ $details['product']['unit']['name'] }}</td>
                                            <td class="text-center">{{ $details->selling_qty }}
                                            {{ $details['product']['unit']['name'] }}</td>
                                            <td class="text-right">{{ number_format($details->unit_price,2).' ৳' }}</td>
                                            <td class="text-right">{{ number_format($details->selling_price,2).' ৳' }}</td>
                                        </tr> 
                                        @php
                                            $total_sum += $details->selling_price;
                                        @endphp
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-right"><strong>Subtotal</strong></td>
                                        <td class="text-right">{{ number_format($total_sum,2). ' ৳' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-right"><strong>Discount</strong></td>
                                        <td class="text-right">{{ number_format($payment->discount_amount,2). ' ৳' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-right"><strong>Paid Amount</strong></td>
                                        <td class="text-right">{{ number_format($payment->paid_amount,2). ' ৳' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-right"><strong>Due Amount</strong></td>
                                        <td class="text-right">{{ number_format($payment->due_amount,2). ' ৳' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <div class="row">
                            <div class="col-lg-12 text-right">
                                {{-- <div class="invoice-detail-item pr-2">
                                    <tr>
                                        <th><strong>Subtotal</strong></th>
                                        <th width="20%">$6</th>
                                    </tr>
                                </div>     
                                <div class="invoice-detail-item pr-2">
                                    <tr class="border">
                                        <th><strong>Subtotal</strong></th>
                                        <th data-width="20%">$670.99</th>
                                    </tr>
                                </div>
                                <div class="invoice-detail-item pr-2">
                                    <tr>
                                        <th><strong>Subtotal</strong></th>
                                        <th data-width="20%">$670.99</th>
                                    </tr>
                                </div>
                                <div class="invoice-detail-item pr-2">
                                    <tr>
                                        <th><strong>Subtotal</strong></th>
                                        <th data-width="20%">$670.99</th>
                                    </tr>
                                </div> --}}
                               
                                    <div class="invoice-detail-item">
                                      <div class="invoice-detail-name pr-2"><strong>Grand Total</strong> </div>
                                      <div class="invoice-detail-value invoice-detail-value-lg pr-2">{{ number_format($payment->total_amount,2). ' ৳' }}</div>
                                    </div>
                                    <div class="text-md-right mt-4">   
                                        <div class="float-lg-left mb-lg-0 mb-3">
                                            <button type="submit" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Approve Invoice</button>
                                          </form> 
                                            <button href="{{ route('invoice.approve.delete',$invoice->id) }}" id="delete" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                                        </div>
                                        <button class="btn btn-warning btn-icon icon-left" onclick="myfun('print')"><i class="fas fa-print"></i> Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript">
    function myfun(paravalue){
       
        // var backup = document.body.innerHTML;
        // var divcontend = document.getElementById(paravalue).innerHTML; 
        // document.body.innerHTML = divcontend;
        window.print();
        // document.body.innerHTML = backup;
    }
</script>
@endsection