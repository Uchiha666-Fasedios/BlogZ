@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

			<div class="card">
        <div class="card-header">Subir nuevo video</div><?php //card-header clases de boostrap me hace como una peqeña caja ?>



				<div class="card-body"><?php //me lo encierra todo en una caja ?>

					<form method="POST" action="{{route('video.save')}}" enctype="multipart/form-data">
						@csrf <?php //para seguridad  ?>

						<div class="form-group row">
							<label for="video_path" class="col-md-3 col-form-label text-md-right">Video</label><?php //col-md-3 le da un tamaño a la caja col-form-label esto lo estiriza text-md-right me mueve el texto a la derecha?>
							<div class="col-md-7"><?php //col-md-7 el tamaño de la caja para q entre el texto ?>
								<input id="video_path" type="file" name="video_path" class="form-control {{ $errors->has('video_path') ? 'is-invalid' : '' }}" onchange="return validarExtensionArchivo()" required/><?php //class="form-control para q este mejor esterilizado con boostrap ?>

								@if($errors->has('video_path'))<?php //$errors->has si me da error la validacion de laravel q este metodo ya fue creado por laravel?>
								<span class="invalid-feedback" role="alert"><?php //class="invalid-feedback" clases de boostrap ?>
									<strong>{{ $errors->first('video_path') }}</strong><?php //first saca el primer error generado ?>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
							<div class="col-md-7">
								<textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required></textarea>

								@if($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group row">

							<div class="col-md-6 offset-md-3"><?php //offset-md-3 me centra el elemento o lo ajusta hacia un lado ?>
								<input type="submit" class="btn btn-primary" value="Subir video">
							</div>
						</div>


					</form>

				</div>
			</div>

        </div>
    </div>
</div>

@endsection
