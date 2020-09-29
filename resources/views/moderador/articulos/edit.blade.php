@extends('layouts.appModerador')

@section('content')
<script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
<form method="POST" action="{{ route('moderador.articulos.update',$articulo->id) }}" enctype="multipart/form-data" class="temaFormuEdit">
	@csrf
	{{ method_field('PUT') }}
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
	            <div class="form-group">
	                <label for="exampleInputPassword1">Titulo</label>
	                <input type="text" class="form-control" name="titulo" value="{{ old('titulo',$articulo->titulo) }}">
	            </div>
	            <hr>
	            <div class="form-group">
	                <label for="exampleInputPassword1">Categoria</label>
		            <select class="form-control" name="theme_id">
						@foreach($temasTodos as $tema){{-- esta viene de AppServiceProvider.php --}}
						  <option value="{{ $tema->id }}" {{ old('theme_id', $articulo->theme_id) == $tema->id ? 'selected' : '' }}>
					        {{ $tema->nombre }}
					      </option>
				        @endforeach
					</select>
				</div>
				<hr>
				<div class="form-group">
	                <label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido',$articulo->contenido) }}</textarea>
					<script>
				      CKEDITOR.replace( 'contenido' );
				    </script>
				</div>
				<hr>
                @foreach($articulo->images as $imagen)
                <img width="190px" src="{{ asset('storage/imagenesArticulos/'.$imagen->nombre) }}">{{-- muestra la imagen --}}
				    <a href="{{ route('moderador.imagen.delete',$imagen) }}">
				      <img style="margin-left: -26px; margin-top: -170px" width="20px" src="{{asset('imagenes/admin/eliminar.png')}}">
				    </a>
				@endforeach
				@if($articulo->images->count()<3)
				    <p><h3>Añadir imágenes (máximo 3 imágenes por artículo)</h3></p>
				@endif
				  <div class="container">
				     @for($i=3;$i>$articulo->images->count();$i--)
				        <div style="margin-top: 20px" class="row">
				          <div style="margin-top: 20px" class="col-1">
				            <input type="file" name="foto{{$i}}">
				          </div>
				        </div>
				     @endfor
				  </div>
                <hr>
                {{--  <button type="submit" class="btn btn-info btn-sm">Actualizar</button> --}}
                {{-- OTRA FORMA DE HACER PILICE PERO EN PLANTILLAS (en esta ocacion oculto el boton si quiero ver el articulo pero no es mi articulo es de otro moderador)--}}
			      @can('edit', $articulo){{--  ESTO ES LA POLITICA HECHA EN App/Policies/ArticlePolicy.php view HACE REFERENCIA A EL METODO Q ESTA AHI Y articulo BUE al articulo q estoy pasando--}}
	            	<button type="submit" class="btn btn-info btn-sm">Actualizar</button>
	            @endcan
	        </div>
	    </div>
	</div>
</form>
@endsection
