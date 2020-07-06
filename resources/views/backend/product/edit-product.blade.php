@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Edit Product</span>
                    <small class="d-sm-block"><a href="{{ route('products.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Product List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update',$editData->id) }}" method="post" id="Product_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="supplier">Supplier Name</label>
                                <select class="form-control" name="supplier_id" id="supplier">
                                    <option value="">Select Supplier</option>
                                    @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->id }}" {{ ($editData->supplier_id == $supplier->id)?'selected':'' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="unit">Unit Name</label>
                                <select class="form-control" name="unit_id" id="unit">
                                    <option value="">Select Unit</option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ ($editData->unit_id == $unit->id)?'selected':'' }}>{{ $unit->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="category">Category Name</label>
                                <select class="form-control" name="category_id" id="category">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}" {{ ($editData->category_id == $cate->id)?'selected':''}}>{{ $cate->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="product">Product Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $editData->name }}" id="product">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
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
    $(document).ready(function () {
      $('#Product_form').validate({
        rules: {
          name: {
            required: true,
          },
          supplier_id: {
            required: true
          },
          unit_id: {
            required: true,
            
          },
          category_id: {
            required: true,
           
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