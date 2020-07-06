@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Product Stock</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-1"></i>View Stock</span>
                    <small class="d-sm-block"><a href="{{ route('stock.report.pdf') }}" class="btn btn-warning btn-sm" target="_blank"><i class="fas fa-print mr-1"></i>Print Stock</a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>In_Qty</th>
                                    <th>Out_Qty</th>
                                    <th>Current_Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($alldata as $key => $product)
                                @php
                                    $buying_qty = App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                                    $selling_qty = App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                                @endphp
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product['supplier']['name'] }}</td>
                                    <td>{{ $product['category']['name'] }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $buying_qty }}
                                        {{ $product['unit']['name'] }}
                                    </td>
                                    <td>{{ $selling_qty }}
                                        {{ $product['unit']['name'] }}
                                    </td>
                                    <td>{{ $product->quantity }}
                                        {{ $product['unit']['name'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>In_Qty</th>
                                    <th>Out_Qty</th>
                                    <th>Stock</th>
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