@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Daily Invoice Report</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-plus-circle mr-1"></i>Select Criteria</span>
                    {{-- <small class="d-sm-block"><a href="{{ route('invoice.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>Purchase List</a></small> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('invoice.daily.report.pdf') }}" method="GET" target="_blank" id="Myform">
                        
                        <div class="form-row">
                            <div class="form-group col-md-2">
                              <label for="start_date">Start Date</label>
                              <input type="text" class="form-control datepicker1" name="start_date" id="start_date" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control datepicker2" name="end_date" id="end_date" placeholder="yyyy-mm-dd" readonly>
                            </div>
                            
                            <div class="form-group col-md-2" style="padding-top: 32px">
                              <button type="submit" class="btn btn-success">Submit</button>
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
    $(document).ready(function () {
      $('#Myform').validate({
        rules: {
         start_date: {
            required: true,
          },
          end_date: {
            required: true
          }
          
        },
        messages: {
        //  start_date: {
        //     required: "Please Select Start Date.",
        //   },
        // end_date: {
        //     required: "Please Enter End Date.",
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
      $('.datepicker1').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd'
      });
      $('.datepicker2').datepicker({
          uiLibrary: 'bootstrap4',
          format:'yyyy-mm-dd'
      });
  </script>
@endsection