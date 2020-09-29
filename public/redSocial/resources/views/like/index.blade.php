@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<h1>Mis imagenes favoritas</h1>
			<hr/>

			@foreach($likes as $like)
				@include('includes.image',['image'=>$like->image])<?php //aca incluyo el include de la tarjeta q utilice en home.blade.php y el parametro es el de la variable del foreach ?>
			@endforeach

			<!-- PAGINACION -->
			<div class="clearfix"></div>
			{{$likes->links()}}
        </div>
    </div>
</div>
@endsection
