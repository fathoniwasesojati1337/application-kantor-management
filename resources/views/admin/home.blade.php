@extends('layouts.admin.app')@section('dashboard')
@if(auth()->user()->status === 'admin')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">data edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
					<div class="form-group">
          <label for="nama_edit">Nama</label>
						<input type="text" name="name" class="form-control" id="nama_edit" aria-describedby="nama_edit" placeholder="Enter name"> <small class="form-text text-muted">We'll never share your name with anyone else.</small> </div>
					<div class="form-group">
						<label for="email_edit">Email </label>
						<input type="email" name="email" class="form-control" id="email_edit" aria-describedby="emailHelp" placeholder="Enter email"> <small class="form-text text-muted">We'll never share your email with anyone else.</small> </div>
            <div class="form-group">
						<label for="nip_edit">NIP </label>
						<input type="text" name="nip" class="form-control" id="nip_edit" aria-describedby="nip_edit" placeholder="Enter nip"> <small class="form-text text-muted">We'll never share your NIP with anyone else.</small> </div>
            <div class="form-group">
						<label for="address_edit">Address </label>
						<input type="text" name="address" class="form-control" id="address_edit" aria-describedby="address_edit" placeholder="Enter address"> <small  class="form-text text-muted">We'll never share your address with anyone else.</small> </div>
            <div class="form-group">
						<label for="provinsi_edit">Provinsi </label>
						<input type="text" name="provinsi" class="form-control" id="provinsi_edit" aria-describedby="provinsi_edit" placeholder="Enter provinsi"> <small  class="form-text text-muted">We'll never share your provinsi with anyone else.</small> </div>
            <div class="custom-file">
            <input type="file" name="foto" id="edit_foto" class="custom-file-input" id="validatedCustomFile">
            <label class="custom-file-label" for="validatedCustomFile">pilih foto...</label>
            </div>
        <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>                  
		</form>
	</div>
</div>
</div>
</div>
  <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
              @if(session('status'))<div class="alert alert-success alert-block" role="alert">
                {{session('status')}}
                </div>@endif                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">table user</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Nip </th>
                            <th> Address </th>
                            <th> Provinsi </th>
                            <th> Tanggal </th>
                            <th> #</th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($user as $x)
                          <tr>
                            <td>
                              <img src="{{asset('image')}}/{{$x->detailt->foto}}" class="mr-2" alt="image"> {{$x->name}}
                            </td>
                            <td>{{ $x->email }}</td>
                            <td>
                            {{ $x->detailt->nip }}
                            </td>
                            <td> {{ $x->detailt->address }} </td>
                            <td> {{ $x->detailt->provinsi }} </td>
                            <td> <?= date("d M, Y", strtotime($x->detailt->created_at)); ?> </td>
                            <td>
                            <button id="edit" data-name="<?= $x->name;?>" data-email="<?= $x->email; ?>" data-nip="<?= $x->detailt->nip; ?>" data-address="<?= $x->detailt->address; ?>"
                            data-id="<?= $x->id; ?>" data-provinsi="<?= $x->detailt->provinsi; ?>" data-foto="<?= $x->detailt->foto; ?>"
                            data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-outline-info">Edit</button>
                            <a href="/dashboard/{{$x->id}}/delete"><button id="delete" class="btn btn-outline-danger">Delete</button></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Project Status</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Due Date </th>
                            <th> Progress </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> 1 </td>
                            <td> Herman Beck </td>
                            <td> May 15, 2015 </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white">Todo</h4>
                    <form id="submitdata">
                    {{ csrf_field()}}
                       <div class="add-items d-flex">
                         <input name="date" class="form-control "  type="date" id="date">
                         <input name="nama" id="nama" type="text" class="form-control" placeholder="What do you need to do today?">
                         <button type="submit" class="btn btn-gradient-primary">Add</button>
                       </div>
                    </form>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom getjson">
                      @foreach($acara as $a)
                      <?php 
                      
                      $today = strtotime("today midnight");

                      ?>
                      @if($a->status !== 'pending' || $today >=  strtotime($a->date. ' + 0 days') )
                        <li class="completed">
                            <input class="checkbox text-justify" checked type="checkbox">{{$a->nama}}
                            <label style="text-align:center" class="badge badge-gradient-success text-justify">done</label>
                            <label style="left: 3em; position:relative"><?= date("Y-m-d", strtotime($a->date)); ?></label>      
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      @else
                      <li>
                            <input class="checkbox text-justify" type="checkbox">{{$a->nama}}
                            <label style="left: 10em; position:relative"><?= date("Y-m-d", strtotime($a->date)); ?></label>           
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      @endif
                      @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      <!-- page-body-wrapper ends -->
<script>

$(document).ready(function(){

  $(this).on("click", "#edit", function(){

    let nama = $(this).data('name');
    let email = $(this).data('email');
    let nip = $(this).data('nip');
    let address = $(this).data('address');
    let provinsi = $(this).data('provinsi');
    var foto = $(this).data('foto');
    let id = $(this).data('id');

    $(".modal-body #nama_edit").val(nama);
    $(".modal-body #email_edit").val(email);
    $(".modal-body #nip_edit").val(nip);
    $(".modal-body #address_edit").val(address);
    $(".modal-body #provinsi_edit").val(provinsi);
    $(".modal-body #edit_foto").attr('src', foto);
    $('form').attr('action', '/dashboard/edit/'+ id); //this fails silently

  });

});

$(document).ready(function(){

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$("#submitdata").submit(function(e){
  e.preventDefault();

  let dt = $("#date").val();
  let nm = $("#nama").val();

  $.ajax({
      url: "{{route('dashboard.acara')}}",
      type: "POST",
      data: {
        nama:nm,
        date:dt,
      },
      success: function(respone){ 
        
        $('.getjson').append('<li><input type="checkbox">' + respone.nama  + '<label style="left: 10em; position:relative">'+ respone.date +'</label>' + '<i class="remove mdi mdi-close-circle-outline"></i></li>')
        
      }
  });

});

});
</script>
@endif
@endsection