@extends('backend.layouts.master')
@section('content')
	
<div id="layoutSidenav_content">
	<main>
        <div class="container-fluid">
            <h3 class="mt-4">IMS_POS</h3>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            {{-- <div class="card mb-4">
                <div class="card-body">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>.</div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-user fa-fw mr-1"></i>View Pofile</span>
                    <small class="d-sm-block"><a href="{{ route('profile.edit') }}" class="btn btn-success btn-sm"><i class="fas fa-edit mr-1"></i> Edit Profile</a></small>
                </div>
                <div class="card-body">
                    <section class="section">
                        <div class="section-body">
                          <div class="row mt-sm-4">
                            <div class="col-12 col-md-12 col-lg-4">
                              <div class="card author-box">
                                <div class="card-body">
                                  <div class="author-box-center">
                                    {{-- <img alt="image" src="{{ asset('public/img') }}/IMG20190314145248.jpg" class="rounded-circle author-box-picture"> --}}
                                    <div class="chat_container" style="background-image: url({{ (!empty($user->image))?url('public/upload/users_images/'.$user->image):url('public/img/default.jpg') }});">
                                        <div class="overlay">
                                            
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="author-box-name">
                                      <a href="#">{{ $user->name }}</a>
                                    </div>
                                    <div class="author-box-job">{{ $user->usertype }}</div>
                                  </div>
                                  <div class="text-center">
                                    <div class="author-box-description">
                                      <p>
                                        {{ (!empty($user->about))?$user->about:'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptatum alias molestias
                                        minus quod dignissimos.' }}
                                      </p>
                                    </div>
                                    <div class="mb-2 mt-3">
                                      <div class="text-small font-weight-bold">Follow Hasan On</div>
                                    </div>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                                      <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                                      <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-github">
                                      <i class="fab fa-github"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                                      <i class="fab fa-instagram"></i>
                                    </a>
                                    <div class="w-100 d-sm-none"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8">
                              <div class="card">
                                <div class="card-header">
                                    <h4>Personal Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="py-4">
                                    <p class="clearfix">
                                        <span class="float-left">
                                        Birthday
                                        </span>
                                        <span class="float-right text-muted">
                                        {{ (!empty($user->dob))?$user->dob:'00-00-0000' }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                        Phone
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ (!empty($user->mobile))?$user->mobile:'(0123)123456789' }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                        Mail
                                        </span>
                                        <span class="float-right text-muted">
                                        {{ $user->email }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                        Address
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ (!empty($user->address))?$user->address:'@Example,@example' }}
                                        </span>
                                    </p>
                                    {{-- <p class="clearfix">
                                        <span class="float-left">
                                        Twitter
                                        </span>
                                        <span class="float-right text-muted">
                                        <a href="#">@johndeo</a>
                                        </span>
                                    </p> --}}
                                    </div>
                                </div>
                              </div>
                           </div>
                       </div>
                     </div>
                   </section>
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