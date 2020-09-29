@extends('layouts.appAdmin')

@section('content')
<script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>{{-- este escrip es para q se vea los emoticones y todo eso q se puede agregar --}}
{{--  route('articulos.store esta ruta ya esta hecha por defecto cuando cree el controlador de tipo resource y de name laravel le puso asi lo puedo ver con php artisan route:list--}}
<form method="POST" action="{{ route('articulos.store') }}" enctype="multipart/form-data" class="temaFormuEdit"> {{-- enctype="multipart/form-data" esto es para subir archivos es de html ya lo teneis q saber :\ --}}
	@csrf
	<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
		@if(session('notificacion'))
	        <div class="alert alert-success" role="alert">
	          {{session('notificacion')}}
	        </div>
	    @endif
		@if($errors->any())
	        <div class="alert alert-danger">
	            <ul>
	                @foreach($errors->all() as $error)

	                    <li>{{ $error }}</li>

	                @endforeach
	            </ul>
	        </div>
	    @endif
	    <div class="row">
	        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
	        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	        	<p><b>Activar</b></p>
	            <div class="radio">
				  <label>
				    <input type="radio" name="activo" value="1" @if((old('activo'))) checked @endif>
				    	Si
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="activo" value="0" @if(!(old('activo'))) checked @endif>
				    	No
				  </label>
				</div>
				<hr>
	            <div class="form-group">
	                <label for="exampleInputPassword1">Titulo</label>
	                <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
	            </div>
	            <hr>
	            <div class="form-group">
	                <label for="exampleInputPassword1">Categoria</label>
		            <select class="form-control" name="theme_id">
                      @foreach($temasTodos as $tema) {{-- temasTodo esta variable la sacamos de app/Providers/AppServiceProvider.php --}}
                      {{-- esto es un select.. old este lo q hace es q si me da un error o por algun caso regreso a cargar la pagina me deje señalado lo q puse--}}
					  <option value="{{ $tema->id }}" @if(old('theme_id') == $tema->id) selected @endif>{{ $tema->nombre }}</option>
					  @endforeach
					</select>
				</div>
				<hr>
				<div class="form-group">
	                <label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido') }}</textarea>{{-- rows="5" esto me saca el alto de la caja --}}
					<script>
				      CKEDITOR.replace( 'contenido' );
				    </script>
				</div>
                <hr>
                {{-- me muestra 3 veces para q elija la imagen --}}
				@for($i=0;$i<3;$i++)
					<div class="col-1">
	                  <input type="file" name="foto{{ $i }}">
	                </div>
	                <hr>
				@endfor
	            <button type="submit" class="btn btn-info btn-sm">Añadir</button>
	        </div>
	    </div>
	</div>
</form>
@endsection
