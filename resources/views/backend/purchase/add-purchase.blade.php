@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Add Purchase</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Purchase</span>
                    <small class="d-sm-block"><a href="{{ route('purchase.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Purchase List</a></small>
                </div>
                <div class="card-body">
                    {{-- <form action="{{ route('purchase.store') }}" method="post" id="Product_form">
                        @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="date">Date</label>
                              <input type="text" class="form-control datepicker" name="date" value="{{ $date }}" id="date" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="purchase_no">Purchase_No</label>
                              <input type="text" class="form-control pur" name="purchase_no" id="purchase_no">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="supplier_id">Supplier Name</label>
                                <select class="form-control form-control-sm select2" name="supplier_id" id="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach ($supplier as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="category_id">Category Name</label>
                                <select class="form-control select2" name="category_id" id="category_id">
                                    <option value="">Select Supplier Name First</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="Product_id">Product Name</label>
                              <select class="form-control select2" name="Product_id" id="Product_id">
                                  <option value="">Select Category First</option>
                              </select>
                            </div>
                            <div class="form-group col-md-4" style="padding-top: 30px">
                              <button class=" text-white btn btn-success addeventmore"><i class="fas fa-plus-circle mr-1"></i>Add Item</button>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="post" id="Myform">
                      @csrf
                      <table class="table-sm table-bordered" width="100%">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th width="7%">Pcs/Kg</th>
                            <th width="10%">Unit Price</th>
                            <th>Description</th>
                            <th width="10%">Total Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="addRow" class="addRow">

                        </tbody>
                        <tbody>
                          <tr>
                            <td colspan="5"></td>
                            <td>
                              <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Purchase Store</button>
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
<script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date[]" value="@{{ date }}">
    <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
    <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="hidden" name="Product_id[]" value="@{{ Product_id }}">
      @{{ Product_name }}
    </td>
    <td>
      <input type="number" step="0.1" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
    </td>
    <td>
      <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    <td>
      <input type="text" name="description[]" class="form-control form-control-sm">
    </td>
    <td>
      <input  name="buying_price[]" value="0" class="form-control form-control-sm text-right buying_price" readonly>
    </td>
    <td><button class="btn btn-danger btn-sm removeeventmore"><i class="fas fa-window-close"></i></button></td>
  </tr>
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("click",".addeventmore",function(){
      
      var date = $('#date').val();
      var purchase_no = $('#purchase_no').val();
      var supplier_id = $('#supplier_id').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var Product_id = $('#Product_id').val();
      var Product_name = $('#Product_id').find('option:selected').text();
      //alert(category_name);
      if(date==''){
        //$.notify("Date is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Date is Required");
        return false;
      }
      if(purchase_no==''){
        // $.notify("Purchase No is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Purchase_No is Required");
        return false;
      }
      if(supplier_id==''){
        //$.notify("Supplier Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Supplier Name is Required");
        return false;
      }
      if(category_id==''){
        //$.notify("Category Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Category Name is Required");
        return false;
      }
      if(Product_id==''){
        //$.notify("Product Name is Required",{globalPosition:'top right',className: 'error'});
        toastr.error("Product Name is Required");
        return false;
      }
      var source = $("#document-template").html();
      var template = Handlebars.compile(source);
      var data = {
        date:date,
        purchase_no:purchase_no,
        supplier_id:supplier_id,
        category_id:category_id,
        category_name:category_name,
        Product_id:Product_id,
        Product_name:Product_name
      };
      var html = template(data);
      $("#addRow").append(html);
    });
    $(document).on("click",".removeeventmore",function(){
      $(this).closest(".delete_add_more_item").remove();
      totalamountPrice();
    });
    $(document).on("keyup click",".unit_price,.buying_qty",function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var buying_qty = $(this).closest("tr").find("input.buying_qty").val();
      var total = unit_price * buying_qty;
      $(this).closest("tr").find("input.buying_price").val(total);
      totalamountPrice();
    });
    function totalamountPrice(){
      var sum = 0;
      $(".buying_price").each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
        }
      });
      $("#estimated_amount").val(sum);
    }

  });

</script>
<script>
  $(document).ready(function(){
    $(document).on('change','#supplier_id',function(){
      var supplier_id = $(this).val();
      // alert(supplier_id);
      $.ajax({
        url:"{{route('get-category')}}",
        type:"GET",
        data:{supplier_id:supplier_id},
        success:function(data){
          var html = '<option value="">Selcet Category</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.category_id+'">'+v.category.name+'</option>';
          });
          $('#category_id').html(html);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      // alert(supplier_id);
      $.ajax({
        url:"{{route('get-product')}}",
        type:"GET",
        data:{category_id:category_id},
        success:function(data){
          var html = '<option value="">Selcet Product</option>';
          $.each(data,function(key,v){
            html +='<option value="'+v.id+'">'+v.name+'</option>';
          });
          $('#Product_id').html(html);
        }
      });
    });
  });
</script>
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
    <script>
      $('.datepicker').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd'
      });
  </script>
@endsection