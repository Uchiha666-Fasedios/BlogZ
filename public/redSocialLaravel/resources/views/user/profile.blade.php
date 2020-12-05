<?php  ?>@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

			<div class="profile-user">

				@if($user->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" />
					</div>
				@endif

				<div class="user-info">
					<h1>{{'@'.$user->nick}}</h1>
					<h2>{{$user->name .' '. $user->surname}}</h2>
					<p>{{'Se unió: '.\FormatTime::LongTimeFilter($user->created_at)}}</p><?php //muestra la fecha  ?>
				</div>

				<div class="clearfix"></div>
				<hr>
			</div>

			<div class="clearfix"></div><?php //esta clase de boostrap limpia paraq lo de abajo no suba no intente adaptarce con stile (limpiar flotados) ?>
<?php //lista de mis imgenes///////////////// ?>
			@foreach($user->images as $image)<?php //hago un bucle pasando al usuario q vino del controlador UserController metodo profile ..con el ORM llamo al metodo images de la clase user?>
				@include('includes.image',['image'=>$image])<?php //muestro la lista de las imagenes del usuario (estoy pasando de parametro 'image' se llama la variable y le paso $image)?>
			@endforeach


        </div>

    </div>
</div>
@endsection
