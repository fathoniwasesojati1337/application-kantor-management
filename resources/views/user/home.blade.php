@extends('layouts.user.app')@section('dashboard')
@if(auth()->user()->status === 'user')
<style>
.responsive {
  max-width: 100%;
  height: 40%;
}
</style>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi penting untuk pegawai</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-body">
						<h5 id="show_judul" class="card-title"></h5>
                        <p id="show_pembukaan" class="card-text"></p>
                        <p id="show_content" class="card-text"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-12 grid-margin stretch-card">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<?php
                    for($i=1;$i<=$jumlah;$i++):
                    ?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>"></li>
						<?php endfor; ?>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active"> <img class="d-block w-100" style="width: 500px; height:500px;" src="/image/ai.jpg" alt="First slide">
						<div class="carousel-caption d-none d-md-block">
							<h5>zaman sekarang iot mulai berkembang pesat</h5>
							<p>untuk para pekerja tolong bekerja sebaik mungkin untuk perusahaaan lebih unggul</p>
						</div>
					</div> @foreach($blog as $b)
					<div class="carousel-item"> <img class="d-block w-100" style="width: 500px; height:500px;" src="{{ asset('image') }}/{{ $b->foto }}" alt="First slide">
						<div class="carousel-caption d-none d-md-block">
							<h5>{{ $b->judul }}</h5>
							<p>{{ $b->pembukaan }}</p>
						</div>
					</div> @endforeach </div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
			</div>
		</div>
	</div>
	<div class="row card-columns">
    @foreach($blog as $b)
		<div class="col">
			<div class="card" style="width: 22rem; height:17rem"> <img class="card-img-top responsive" src="/image/{{ $b->foto }}" alt="Card image cap">
				<div class="card-body">
                    <p class="card-text">{{ $b->judul }} </p><a href="#" id="readmore"
                    data-judul="<?= $b->judul ?>" data-pembukaan="<?= $b->pembukaan ?>" data-content="<?= $b->content ?>" data-foto="<?= $b->foto ?>" 
                    data-toggle="modal" data-target=".bd-example-modal-lg">readmore...</a>
					<p class="card-text"><small class="text-muted">Last updated {{ date("Y, M d", strtotime($b->tanggal_blog)) }}</small></p>
				</div>
			</div>
        </div>
    @endforeach
	</div>
</div>
<script>
    $(document).ready(function(){
        $(this).on("click", "#readmore", function(e){
            e.preventDefault();
            let judul   = $(this).data("judul");
            let content = $(this).data("content");
            let foto = $(this).data("foto");
            let pembukaan = $(this).data("pembukaan");
            $("#show_judul").html(judul);
            $("#show_pembukaan").html(pembukaan);
            $("#show_content").html(content);
        })
    })

</script>
@endif
@endsection