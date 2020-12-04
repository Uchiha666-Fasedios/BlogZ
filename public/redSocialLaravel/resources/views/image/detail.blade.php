@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			@include('includes.message')

			<div class="card pub_image pub_image_detail">
				<div class="card-header">

					@if($image->user->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
					</div>
					@endif

					<div class="data-user">
						{{$image->user->name.' '.$image->user->surname}}
						<span class="nickname">
							{{' | @'.$image->user->nick}}
						</span>
					</div>
				</div>

				<div class="card-body">
					<div class="image-container image-detail">
						<img src="{{ route('image.file',['filename' => $image->image_path]) }}" />
					</div>

					<div class="description">
						<span class="nickname">{{'@'.$image->user->nick}} </span>
            <?php //utilizo HELPERS FormatTime::LongTimeFilte es la clase y el metodo q estan en app/Helpers?>
						<span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
            <?php ///////////////////////////////////////////////////////////////////////////////////////// ?>
						<p>{{$image->description}}</p>
					</div>

          <div class="likes">

            <?php //COMPROBAR SI EL USUARIO LE DIO LIKE A LA IMAGEN ?>
            <?php $user_like = false; ?>

            @foreach($image->likes as $like)

            @if($like->user->id == Auth::user()->id)<?php //si el id del usuario q he guardado dentro de la tabla likes es igual al id del usuario identificado ?>
            <?php $user_like = true; ?>
            @endif

            @endforeach



          <?php ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
          <?php //SE HIZO UN ARCHIVO JAVA EN resources/asset/js y lo invoco desde el header la vista de layouts/app.blade.php donde estan los script?>
          <?php ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>


            @if($user_like)
          <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-like" ><?php //asset en laravel es ir al directorio public ?>
          @else
          <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-dislike" ><?php //asset en laravel es ir al directorio public ?>
          @endif
          <span class="number_likes">  {{count($image->likes)}}<?php //cuenta la cantidad de likes de tal imagen gracias a la ORM?></span>
          </div>

					@if(Auth::user() && Auth::user()->id == $image->user->id)
					<div class="actions">


						<a href="{{route('image.edit',['id'=>$image->id])}}" class="btn btn-sm btn-primary">Actualizar</a>

  <?php //ESTE CODIGO ESTA HECHO POR BOOSTRAP 4 SE LLAMA MODAL?>
						<!-- Button to Open the Modal -->
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
							Eliminar
						</button>

						<!-- The Modal -->
						<div class="modal" id="myModal">
							<div class="modal-dialog">
								<div class="modal-content">

									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">¿Estas seguro?</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										Si eliminar esta imagen nunca podrás recuperarla, ¿estas seguro de querer borrarla?
									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
										<a href="{{route('image.delete',['id'=>$image->id])}}" class="btn btn-danger">Borrar definitivamente</a>
									</div>

								</div>
							</div>
						</div>
					</div>
					@endif

					<div class="clearfix"></div>
					<div class="comments">

						<h2>Comentarios ({{count($image->comments)}})</h2>
						<hr>

						<form method="POST" action="{{ route('comment.save') }}">
							@csrf

							<input type="hidden" name="image_id" value="{{$image->id}}" />
							<p>
								<textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea><?php //si da error pongo is-invalid q es una clase de boostrap ?>
								@if($errors->has('content'))<?php //$errors->has significa si me da error la validacion de laravel, este metodo ya fue creado por laravel?>
								<span class="invalid-feedback" role="alert"><?php //invalid-feedback clase de boostrap ?>
									<strong>{{ $errors->first('content') }}</strong><?php //$errors->first muestro el error ?>
								</span>
								@endif
							</p>
							<button type="submit" class="btn btn-success">
								Enviar
							</button>
						</form>

						<hr>
<?php //muestro lista de los comentarios ?>

						@foreach($image->comments as $comment)<?php //$image es un objeto q me llega del controlador ImageController y al ser un ORM se puede hacer la magia $image->comments llama al metodo comments de la clase Image y ese metodo llama a la tabla comments y sacar solo los comentarios de esa imagen por la relacion de los id?>
						<div class="comment">

							<span class="nickname">{{'@'.$comment->user->nick}} </span><?php //gracias a la ORM LO Q HACEMOS ACA ES LLAMAR AL METODO user de Image ?>
              <?php //utilizo HELPERS FormatTime::LongTimeFilte es la clase y el metodo q estan en app/Helpers?>
							<span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
              <?php ////////////////////////////////////////////////////////////////////////////////////////// ?>
							<p>{{$comment->content}}<br/><?php //muestro el comentario ?>
          <?php   //este boton aparecera cuando Auth::check() me saca si estoy identificado y el logeado sea el duenio de la imagen o del comentario?>
								@if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
								<a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
									Eliminar
								</a>
								@endif
							</p>
						</div>


						@endforeach

					</div>
				</div>
			</div>


        </div>

    </div>
</div>
@endsection
