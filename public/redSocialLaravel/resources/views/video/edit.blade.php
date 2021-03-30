@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

			<div class="card">
				<div class="card-header">Editar mi video</div>


				<div class="card-body">
          <?php //formulario para editar la imagen ?>

					<form method="POST" action="{{ route('video.update') }}" enctype="multipart/form-data"><?php //aca le indico a donde van los datos  ?>
						@csrf

						<input type="hidden" name="image_id" value="{{$video->id}}" />

						<div class="form-group row">
							<label for="video_path" class="col-md-3 col-form-label text-md-right">Video</label>
							<div class="col-md-7">
								@if($video->user->image)<?php //$image va al metodo user de la clase Image y hago relacion con tabla user y tabla images gracias a ORM y puedo sacar las propiedades de estas tablas que tengan smejanza con el id de(user) y user_id de(images)?>
								<div class="container-avatar">
								<iframe width="300" height="300" src="{{asset('../storage/app/images/'. $video->video_path.'?rel=0' )}}"  frameborder="0" allowfullscreen></iframe>
								</div>
								@endif
								<input id="video_path" type="file" name="video_path" class="form-control {{ $errors->has('video_path') ? 'is-invalid' : '' }}" />

								@if($errors->has('video_path'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('video_path') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
							<div class="col-md-7">
								<textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required>{{$video->description}}</textarea>

								@if($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">

							<div class="col-md-6 offset-md-3">
								<input type="submit" class="btn btn-primary" value="Actualizar video">
							</div>
						</div>


					</form>

				</div>
			</div>

        </div>
    </div>
</div>

@endsection
