@extends('layouts.user.app')@section('dashboard') @if(auth()->user()->status === 'user')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- plugins:js -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title text-white">Todo</h4>
					<form id="submitdata"> {{ csrf_field()}}
						<div class="add-items d-flex">
							<input name="date" class="form-control " type="date" id="date">
							<input name="nama" id="nama" type="text" class="form-control" placeholder="What do you need to do today?">
							<button type="submit" class="btn btn-gradient-primary">Add</button>
						</div>
					</form>
					<div class="list-wrapper">
						<ul class="d-flex flex-column-reverse todo-list todo-list-custom getjson"> @foreach($acara as $a)
							<?php 
                      $today = strtotime("today midnight");
                      ?> @if($a->status !== 'pending' || $today >= strtotime($a->date. ' + 0 days') )
								<li class="completed">
									<input class="checkbox text-justify" checked type="checkbox">{{$a->nama}}
									<label style="text-align:center" class="badge badge-gradient-success text-justify">done</label>
									<label style="left: 10em; position:relative">
										<?= date("Y-m-d", strtotime($a->date)); ?>
									</label> <i class="remove mdi mdi-close-circle-outline"></i> </li> @else
								<li>
									<input class="checkbox text-justify" type="checkbox">{{$a->nama}}
									<label style="left: 10em; position:relative">
										<?= date("Y-m-d", strtotime($a->date)); ?>
									</label> <i class="remove mdi mdi-close-circle-outline"></i> </li> @endif @endforeach </ul>
						<div style="left: 20em; position:relative" class="pagination text-center">{{ $acara->links() }} </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col col-md-6">
			<div class="monthly" id="mycalendar"></div>
		</div>
	</div>
</div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/monthly.js')}}"></script>
<script type="text/javascript">
function jaxrue() {
	$.ajax({
		url: '/api/acara',
		type: 'GET',
		dataType: 'json',
		success: function(data) {
			$(window).load(function() {
				$('#mycalendar').monthly({
					mode: 'event',
					dataType: 'json',
					events: data
				});
			});
		}
	});
}
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#submitdata").submit(function(e) {
		e.preventDefault();
		let dt = $("#date").val();
		let nm = $("#nama").val();
		$.ajax({
			url: "{{route('dashboard.acara')}}",
			type: "POST",
			data: {
				nama: nm,
				date: dt,
			},
			success: function(respone) {
				$('.getjson').append('<li><input type="checkbox">' + respone.nama + '<label style="left: 10em; position:relative">' + respone.date + '</label>' + '<i class="remove mdi mdi-close-circle-outline"></i></li>')
				location.reload();
			}
		});
	});
});
jaxrue()
</script> @endif @endsection