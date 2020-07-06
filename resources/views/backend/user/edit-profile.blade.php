@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
          <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-edit mr-1"></i>Edit Profile</span>
                    <small class="d-sm-block"><a href="{{ route('profile.view') }}" class="btn btn-success btn-sm"><i class="fas fa-user mr-1"></i>View Profile</a></small>
                </div>
                <div class="card-body">

                    <form action="{{ route('profile.update') }}" method="post" id="Myform" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" value="{{ $editdata->name }}" name="name" id="name">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" value="{{ $editdata->email }}"  name="email" id="email">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="moblie">Moblie</label>
                              <input type="text" class="form-control" value="{{ $editdata->mobile }}"  name="moblie" id="moblie">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" value="{{ $editdata->address }}" name="address" id="address">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="dob">Date Of Birth</label>
                              <input type="date" class="form-control" value="{{ $editdata->dob }}"  name="dob" id="dob">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="about">About</label>
                              <textarea name="about" class="form-control" id="about">{{ $editdata->about }}</textarea>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="file" style="background: #1A73E8;padding: 5px 21px;text-transform: uppercase;color: #fff;cursor: pointer;border-radius: 2px;"><i class="fas fa-cloud-upload-alt"></i> change Photo</label>
                              
                              <input type="file" name="file" style="display: none" id="file" />
                              <div class="mt-2" id="test">
                                <img class="img-fluid img-thumbnail" src="{{ (!empty($editdata->image))?url('public/upload/users_images/'.$editdata->image):url('public/img/default.jpg') }}" alt="" width="150px" height="150px">
                              </div>
                            </div>
                            
                            {{-- <div class="form-group col-md-4">
                                <label for="usertype">User Role</label>
                                <select class="form-control" name="usertype" id="usertype">
                                    <option value="">Select Role</option>
                                    <option value="Admin" {{ ($editdata->usertype == "Admin")?"selected":"" }}>Admin</option>
                                    <option value="User" {{ ($editdata->usertype == "User")?"selected":"" }}>User</option>
                                </select>
                            </div> --}}
              
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        usertype: {
            required: true,
          },
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          }
        //   password: {
        //     required: true,
        //     minlength: 6
        //   },
        //   password2: {
        //     required: true,
        //     equalTo : '#password'
        //   }
          
        },
        messages: {
          usertype: {
            required: "Please Select User Role",
          },
          name: {
            required: "Please Enter Name",
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          }
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