@extends('layouts.user.app')@section('dashboard')
@if(auth()->user()->status === 'user')
<div class="container-fluid">
<div class="row justify-content-center">
		<div class="col-sm-8 grid-margin">
			<ul class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center"> Cras justo odio <span class="badge badge-primary badge-pill">14</span> </li>
				<li class="list-group-item d-flex justify-content-between align-items-center"> Dapibus ac facilisis in <span class="badge badge-primary badge-pill">2</span> </li>
				<li class="list-group-item d-flex justify-content-between align-items-center"> Morbi leo risus <span class="badge badge-primary badge-pill">1</span> </li>
			</ul>
		</div>
	</div>
</div>
@endif @endsection