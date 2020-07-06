@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pending Purchase</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Purchase</span>
                    <small class="d-sm-block"><a href="{{ route('purchase.add') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle mr-1"></i> Add Purchase</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Purchase No</th>
                                    <th>Date</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Buying Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($alldata as $key => $purchase)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $purchase->purchase_no }}</td>
                                    <td>{{ date('d-m-Y',strtotime($purchase->date)) }}</td>
                                    <td>{{ $purchase['supplier']['name'] }}</td>
                                    <td>{{ $purchase['category']['name'] }}</td>
                                    <td>{{ $purchase['product']['name'] }}</td>
                                    <td>{{ $purchase->description }}</td>
                                    <td>
                                        {{ $purchase->buying_qty }}
                                        {{ $purchase['product']['unit']['name'] }}

                                    </td>
                                    <td>{{ $purchase->unit_price }}</td>
                                    <td>{{ $purchase->buying_price }}</td>
                                    <td>
                                        @if ($purchase->status == '0')
                                            <span class="btn btn-danger btn-sm">Pending</span>
                                            @elseif ($purchase->status == '1')
                                            <span class="btn btn-success btn-sm">Approved</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('purchase.edit',$purchase->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-1"></i></a> --}}

                                        <a href="{{ route('purchase.approve',$purchase->id) }}" id="approve" title="Approve" class="btn btn-success btn-sm"><i class="fas fa-check-circle mr-1"></i></a>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Purchase No</th>
                                    <th>Date</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Buying Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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
@endsection