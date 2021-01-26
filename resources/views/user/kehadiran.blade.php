@extends('layouts.user.app')@section('dashboard') @if(auth()->user()->status === 'user')
<div class="container-fluid">
	<div class="row">
		<div class="col-12 ">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">kehadiran pegawai</h4>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th> nama </th>
									<th> card number </th>
									<th> status </th>
									<th> nip </th>
									<th> tanggal </th>
								</tr>
							</thead>
							<tbody id="getdata"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('.table').DataTable();
});
setInterval(function() {
	update();
}, 10);

function update() {
	$.getJSON("/api/absensi", function(data) {
		$("#getdata").empty();
		var no = 1;
		$.each(data, function(dt, result) {
			$("#getdata").append('<tr><td><img src="image/' + result.foto + '" class="mr-2" alt="image">' + result.name + ' </td><td> ' + result.card_number + ' </td><td><label class="badge badge-gradient-success">' + result.value + '</label></td><td>' + this.nip + '</td> <td> ' + result.tanggal + ' </td></tr>');
		});
	});
}
</script> @endif @endsection