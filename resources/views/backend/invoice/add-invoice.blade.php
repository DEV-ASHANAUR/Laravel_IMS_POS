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
                    <span><i class="fas fa-plus-circle mr-1"></i>Add Invoice</span>
                    <small class="d-sm-block"><a href="{{ route('invoice.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Purchase List</a></small>
                </div>
                <div class="card-body">
                    {{-- <form action="{{ route('purchase.store') }}" method="post" id="Product_form">
                        @csrf --}}
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="invoice_no">Invoice No</label>
                                <input type="text" value="{{ $invoice_no }}" class="form-control pur" name="invoice_no" id="invoice_no" readonly>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="date">Date</label>
                              <input type="text" class="form-control datepicker" name="date" id="date" value="{{ $date }}" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="category_id">Category Name</label>
                                <select class="form-control select2" name="category_id" id="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>   
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="Product_id">Product Name</label>
                              <select class="form-control select2" name="Product_id" id="Product_id">
                                  <option value="">Select Category First</option>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="stock">Stock (pcs/kg) </label>
                                <input type="text" class="form-control pur" name="stock" id="stock" readonly>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="buying">Buying Price</label>
                              <input type="text" class="form-control pur" name="buying" id="buying" readonly>
                          </div>
                            <div class="form-group col-md-2" style="padding-top: 30px">
                              <button class=" text-white btn btn-success addeventmore"><i class="fas fa-plus-circle mr-1"></i>Add Item</button>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('invoice.store') }}" method="post" id="Myform">
                      @csrf
                      <table class="table-sm table-bordered" width="100%">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th width="7%">Pcs/Kg</th>
                            <th width="10%">Unit Price</th>
                            <th width="17%">Total Price</th>
                            <th width="10%">Action</th>
                          </tr>
                        </thead>
                        <tbody id="addRow" class="addRow">

                        </tbody>
                        <tbody>
                          <tr>
                            <th class="text-right" colspan="4">Discount</th>
                            <td>
                              <input type="text" name="discount_amount" id="discount_amount" class="form-control discount_amount text-right" placeholder="Discount Amount">
                            </td>
                          </tr>
                          <tr>
                            <th class="text-right" colspan="4">Grand Total</th>
                            <td>
                              <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <textarea name="description" class="form-control mt-2" id="description" placeholder="Description Write Here.."></textarea>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="paid_status">Paid Status</label>
                          <select name="paid_status" id="paid_status" class="form-control">
                              <option value="">Select Status</option>
                              <option value="full_paid">Full Paid</option>
                              <option value="full_due">Full Due</option>
                              <option value="partial_paid">Partial Paid</option>
                          </select>
                          <input type="text" class="form-control form-control-sm mt-1 paid_amount" name="paid_amount" placeholder="Enter Paid Amount" style="display: none">
                        </div>
                        <div class="form-group col-md-9">
                          <label>Customer Name</label>
                          <select name="customer_id" id="customer_id" class="form-control select2">
                            <option value="">Select Customer</option>
                            <option value="0">New Customer</option>
                            @foreach ($customer as $customer)
                              <option value="{{ $customer->id }}">{{ $customer->name}} ({{ $customer->mobile_no}} - {{$customer->address }})</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-row new_customer" style="display: none">
                        <div class=" form-group col-md-4">
                          <input type="text" class="form-control" name="name" id="name" placeholder="Customers Name">
                        </div>
                        <div class="form-group col-md-4">
                          <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Customers Mobile_No">
                        </div>
                        <div class="form-group col-md-4">
                          <input type="text" class="form-control" name="address" id="address" placeholder="Customers Address">
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2">Invoice Store</button>
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
    <input type="hidden" name="date" value="@{{ date }}">
    <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="hidden" name="Product_id[]" value="@{{ Product_id }}">
      @{{ Product_name }}
    </td>
    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
    </td>
    <td>
      <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    <td>
      <input  name="selling_price[]" value="0" class="form-control form-control-sm text-right selling_price" readonly>
    </td>
    <td><button class="btn btn-danger btn-sm removeeventmore"><i class="fas fa-window-close"></i></button></td>
  </tr>
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("click",".addeventmore",function(){
      
      var date = $('#date').val();
      var invoice_no = $('#invoice_no').val();
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
        invoice_no:invoice_no,
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
    $(document).on("keyup click",".unit_price,.selling_qty",function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var selling_qty = $(this).closest("tr").find("input.selling_qty").val();
      var total = unit_price * selling_qty;
      $(this).closest("tr").find("input.selling_price").val(total);
      $('#discount_amount').trigger('keyup');
    });
    $(document).on('keyup','#discount_amount',function(){
      totalamountPrice();
    });
    function totalamountPrice(){
      var sum = 0;
      $(".selling_price").each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
        }
      });
      //if discount
      var discount_amount = parseFloat($('#discount_amount').val());
      if(!isNaN(discount_amount) && discount_amount.length !=0 ){
        sum -= parseFloat(discount_amount);
      }
      $("#estimated_amount").val(sum);
    }

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
    $(document).ready(function(){
      $(document).on('change','#Product_id',function(){
        var Product_id = $(this).val();
        // alert(supplier_id);
        $.ajax({
          url:"{{route('check-product-stock')}}",
          type:"GET",
          data:{Product_id:Product_id},
          success:function(data){
            //console.log(data[0].quantity);
            $('#stock').val(data[0].quantity);
            //console.log(data[0].purchase.unit_price);
            $('#buying').val(data[0].purchase.unit_price);
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
      $(document).on('change','#paid_status',function(){
        var paid_status =  $(this).val();
        if(paid_status == 'partial_paid'){
          $('.paid_amount').show();
        }else{
          $('.paid_amount').hide();
        }
      });
      $(document).on('change','#customer_id',function(){
        var customer_id =  $(this).val();
        if(customer_id == '0'){
          $('.new_customer').show();
        }else{
          $('.new_customer').hide();
        }
      });
    </script>
    <script>
      $('.datepicker').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd'
      });
  </script>
@endsection