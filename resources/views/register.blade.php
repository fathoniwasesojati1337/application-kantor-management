@extends('layouts.login')@section('login')
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth">
			<div class="row flex-grow">
				<div class="col-lg-4 mx-auto">
					<div class="auth-form-light text-left p-5">
						<div class="brand-logo"> </div>
						<h4 style="text-align: center;">register for user in here.</h4>
						<h6 style="text-align: center;" class="font-weight-light">Sign up to register account.</h6>
						<form class="pt-3" method="post" action="/register" enctype="multipart/form-data"> @if(session('status'))
							<p class="alert alert-danger">{{session('status')}}</p> @endif {{ csrf_field() }}
							<div class="form-group">
								<input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" placeholder="name"> </div> @error('name')
							<div class="alert alert-danger">nama harus di isi</div>@enderror
							<div class="form-group">
								<input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror " id="email" name="email" placeholder="email"> </div> @error('email')
							<div class="alert alert-danger">email tidak valid atau sudah ada</div>@enderror
							<div class="form-group">
								<input type="text" class="form-control form-control-lg @error('nip') is-invalid @enderror " id="nip" name="nip" placeholder="nip"> </div> @error('nip')
							<div class="alert alert-danger">nip harus di isi max:10</div>@enderror
							<div class="form-group">
								<input type="text" class="form-control form-control-lg @error('pegawai') is-invalid @enderror " id="pegawai" name="pegawai" placeholder="nama jabatan"> </div> @error('pegawai')
							<div class="alert alert-danger">nama jabatan harus di isi</div>@enderror
							<div class="form-group">
								<input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror " id="address" name="address" placeholder="address"> </div> @error('address')
							<div class="alert alert-danger">alamat harus di isi</div>@enderror
							<div class="form-group">
								<select name="provinsi" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
									<option selected>pilih provinsi...</option>
									<option value="jawa tengah">jawa tengah</option>
									<option value="jawa timur">jawa timur</option>
									<option value="jawa barat">jawa barat</option>
									<option value="jakarta">jakarta</option>
								</select>
							</div>
							<div class="form-group">
								<input type="password" class="form-control form-control-lg  @error('password') is-invalid @enderror " id="exampleInputPassword1" name="password" placeholder="password"> </div> @error('password')
							<div class="alert alert-danger">{{$message}}</div>@enderror
							<div class="form-group">
								<input type="password" class="form-control form-control-lg  @error('password_confirm') is-invalid @enderror " id="exampleInputPassword1" name="password_confirm" placeholder="password confirm"> </div> @error('password_confirm')
							<div class="alert alert-danger">{{$message}}</div>@enderror
							<div class="custom-file">
								<input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required>
								<label class="custom-file-label" for="validatedCustomFile">pilih foto...</label>
							</div>
							<div class="mt-3">
								<button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
							</div>
							<div class="text-center mt-4 font-weight-light"> Already have an account? <a href="/" class="text-primary">Login</a> </div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- content-wrapper ends -->
	</div>
	<!-- page-body-wrapper ends -->
</div> @endsection