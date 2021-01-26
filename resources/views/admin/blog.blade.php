@extends('layouts.admin.app')@section('dashboard') @if(auth()->user()->status === 'admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
	<div class="row">
		<div class="col col-sm-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title text-white">Todo</h4> @if(session('status'))
					<p class="alert alert-success">{{ session('status') }}</p> @endif @if(session('gagal'))
					<p class="alert alert-danger">{{ session('gagal') }}</p> @endif
					<form action="/input/blog" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
						<div class="form-group">
							<label for="judul">Judul</label>
							<input name="judul" type="text" class="form-control" id="judul" aria-describedby="emailHelp" placeholder="Enter judul"> <small id="emailHelp" class="form-text text-muted">input judul content blog</small> </div>
						<div class="form-group">
							<label for="judul">Pembukaan</label>
							<input name="pembukaan" type="text" class="form-control" id="pembukaan" aria-describedby="pembukaan" placeholder="Enter pembukaan"> <small id="pembukaan" class="form-text text-muted">input pembukaan content blog</small> </div>
						<div class="form-group">
							<textarea name="content" id="editor" rows="10" cols="80"> isi content terlebih dahulu </textarea>
							<div class="custom-file">
								<input name="foto" type="file" class="custom-file-input" id="customFile">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
							<br>
							<button type="submit" class="btn btn-primary">Submit</button>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('node_modules/ckeditor/ckeditor.js')}}"></script>
	<script>
	CKEDITOR.replace('editor');
	</script> @endif @endsection