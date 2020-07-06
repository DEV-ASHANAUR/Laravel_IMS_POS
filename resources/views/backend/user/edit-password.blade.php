@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Manage Password</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-edit mr-1"></i>Change Password</span>
                    {{-- <small class="d-sm-block"><a href="{{ route('users.view') }}" class="btn btn-success btn-sm"><i class="fas fa-list mr-1"></i>User List</a></small> --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.pass.change') }}" method="post" id="Myform">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cur_password">Current Password</label>
                                <input type="password" class="form-control" name="cur_password" id="cur_password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password2">Confirm Password</label>
                                <input type="password" class="form-control" name="password2" id="password2">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Change</button>
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
         cur_password: {
            required: true,
          },
          new_password: {
            required: true,
            minlength: 6
          },
          password2: {
            required: true,
            equalTo : '#new_password'
          }
          
        },
        messages: {
          cur_password: {
            required: "Please Enter Current password"
          },
          new_password: {
            required: "Please Enter New password",
            minlength: "Your password must be at least 6 characters long"
          },
          password2: {
            required: "Please Enter Confirm password",
            equalTo : "Confirm Password Does not Match"
          }
          
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