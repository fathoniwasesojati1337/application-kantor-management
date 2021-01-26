@extends('layouts.admin.app')@section('dashboard') @if(auth()->user()->status === 'admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- plugins:js -->
<div class="container-fluid">
	<div class="row">
		<div class="col col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="list-wrapper">
						<ul class="d-flex flex-column-reverse todo-list todo-list-custom getjson"> @foreach($proyek as $a)
							<?php 
  $today = strtotime("today midnight");
  ?> @if($today >= strtotime($a->enddate. ' + 0 days'))
								<li class="completed">
									<input class="checkbox text-justify" checked type="checkbox">{{$a->name}}
									<label style="left: 2em; position:relative">
										<?= date("Y-m-d", strtotime($a->enddate)); ?>
									</label>
									<label style="left: 3em; position:relative" class="badge badge-gradient-success text-justify">done</label> <i class="remove mdi mdi-close-circle-outline"></i> </li> @else
								<li>
									<input class="checkbox text-justify" type="checkbox">{{$a->name}}
									<label style="left: 2em; position:relative">
										<?= date("Y-m-d", strtotime($a->enddate)); ?>
									</label>
                <label style="left: 3em; position:relative" class="badge badge-gradient-danger text-justify">waiting</label> <i class="remove mdi mdi-close-circle-outline"></i> 
              </li> @endif @endforeach </ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col col-sm-12">
			<div class="card">
				<div class="card-body">
					<form id="submitdata"> {{ csrf_field()}}
						<div class="add-items d-flex">
							<div class="col-xs-4">
								<input class="form-control " type="date" id="date"> </div>
							<div class="col-xs-4">
								<input class="form-control " type="date" id="enddate"> </div>
							<input id="name" type="text" class="form-control" placeholder="name proyek">
							<select id="user_id" class="custom-select" multiple="multiple">
								<option selected>choose</option> @foreach($user as $u)
								<option value="{{ $u->id }}">{{$u->name}} ({{$u->detailt->pegawai}})</option> @endforeach </select>
							<select id="color" class="custom-select" multiple="multiple">
								<option selected>choose</option>
								<option value="red">red</option>
								<option value="blue">blue</option>
								<option value="green">green</option>
								<option value="yellow">yellow</option>
								<option value="black">black</option>
								<option value="pink">pink</option>
								<option value="purple">purple</option>
								<option value="violet">violet</option>
								<option value="gray">gray</option>
							</select>
							<button type="submit" class="btn btn-gradient-primary mb-5">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col col-sm-12 align-content-sm-center">
			<div class="monthly" id="mycalendar"></div>
		</div>
	</div>
</div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/monthly_proyek.js')}}"></script>
<script type="text/javascript">
function jaxrue() {
	$.ajax({
		url: '/api/proyek',
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
jaxrue();
$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#submitdata").submit(function(e) {
		e.preventDefault();
		let dt = $("#date").val();
		let enddt = $("#enddate").val();
		let clor = $("#color option:selected").val();
		let uid = $("#user_id option:selected").val();
		let nm = $("#name").val();
		$.ajax({
			url: "{{route('input.project')}}",
			type: "POST",
			data: {
				user_id: uid,
				name: nm,
				startdate: dt,
				enddate: enddt,
				color: clor
			},
			success: function(respone) {
				$('.getjson').append('<li><input type="checkbox">' + respone.user_name + '<label style="left: 3.2em; position:relative">' + respone.enddate + '</label>')
				setTimeout(function() {
					location.reload();
				}, 2000);
			}
		});
	});
});
</script> @endif @endsection