@extends('layouts.user.app')@section('dashboard')
@if(auth()->user()->status === 'user')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <div class="row">
        <div class="col col-sm-12">
        <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-white"></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-white"></h4>
                    <div class="monthly" id="mycalendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/monthly_proyek.js')}}"></script>
<script>
function jaxrue(){
$.ajax({
    url: '/api/proyek/user',
    type: 'GET',
    dataType: 'json',
    success: function(data){
        $(window).load( function() {
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
</script>
@endif
@endsection