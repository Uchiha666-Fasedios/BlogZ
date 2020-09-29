@extends('layouts.appAdmin')

@section('content')
<div style="margin-top:150px; margin-bottom:180px;" class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
	    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	    	@foreach($imagenes as $imagen)
                <img width="230px" src="{{ asset('storage/imagenesArticulos/'.$imagen->nombre) }}">
	    	@endforeach
	    </div>
	</div>
	<div style=" margin-top: 20px" class="row">
		<div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			{!! $articulo->contenido !!}
		</div>
	</div>
</div>
@endsection
