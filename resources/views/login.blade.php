@extends('layouts.login') @section('login')
<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth">
				<div class="row flex-grow">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left p-5">
							<div class="brand-logo"> </div>
							<h4 style="text-align: center;">welcome to log in website.</h4>
							<h6 style="text-align: center;" class="font-weight-light">Sign in to continue.</h6> @if(session('status'))
							<div class="alert alert-success" role="alert"> {{session('status')}} </div>@endif @if(session('login'))
							<div class="alert alert-danger" role="alert"> {{session('login')}} </div>@endif
							<form method="POST" action="/" class="pt-3"> {{ csrf_field() }}
								<div class="form-group">
									<input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email" name="email"> </div>
								<div class="form-group">
									<input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password"> </div>
								<div class="mt-3">
									<button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<div class="form-check">
										<label class="form-check-label text-muted">
											<input type="checkbox" class="form-check-input" name="remember_me"> Keep me signed in </label>
									</div> <a href="#" class="auth-link text-black">Forgot password?</a> </div>
								<div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="/register" class="text-primary">Create</a> </div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>@endsection