

<div class="card pub_image"><?php //class="card pub_image" con estyle de css la hago redondita y chiquita la imagen ?>
	<div class="card-header">

		@if($image->user->image)
		<div class="container-avatar">
			<!--  <img src="{{ url('/user/avatar/'.Auth::user()->image) }}" alt=""/> --><?php //puede ser asi tambien ?>
			<img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
		</div>
		@endif

		<div class="data-user"><?php// con style de css lo modifiqe  ?>
			<a href="{{ route('profile', ['id' => $image->user->id])}}">
				{{$image->user->name.' '.$image->user->surname}}<?php //esto viene del controlador HomeController ?>
				<span class="nickname">
					{{' | @'.$image->user->nick}}
				</span>
			</a>
		</div>
	</div>

	<div class="card-body">
		<div class="image-container">
			<img src="{{ route('image.file',['filename' => $image->image_path]) }}" />
		</div>

		<div class="description">
			<?php //utilizo HELPERS FormatTime::LongTimeFilte es la clase y el metodo q estan en app/Helpers SE PUEDE INVOCAR DE CUALQUIER LADO
			//TAMBIEN SE NECESITA USAR ARTISAN ?>
			<span class="nickname">{{'@'.$image->user->nick}} </span>
			<span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
			<p>{{$image->description}}</p>
		</div>

		<div class="likes">

			<!-- Comprobar si el usuario le dio like a la imagen -->
			<?php $user_like = false; ?>
			@foreach($image->likes as $like)
			@if($like->user->id == Auth::user()->id)<?php //si el id del usuario q he guardado dentro de la tabla likes es igual al id del usuario identificado ?>
			<?php $user_like = true; ?>
			@endif
			@endforeach

			@if($user_like)<?php //si es true es q este usuario ya le habia tocado el corazon y entro aca ?>
			<img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike"/><?php //muestra el corazon rojo ?>
			@else
			<img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like"/>
			@endif

			<span class="number_likes">{{count($image->likes)}}</span> <?php //me muestra el numero de los likes de tal persona ?>
		</div>

		<div class="comments">
			<a href="{{ route('image.detail', ['id' => $image->id])}}" class="btn btn-sm btn-warning btn-comments">
				Comentarios ({{count($image->comments)}}) <?php //me muestra el numero de los comentarios de tal persona ?>
			</a>
		</div>
	</div>
</div>

