@extends('layouts.appAdmin')

@section('content')
<script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>{{-- este escrip es para q se vea los emoticones y todo eso q se puede agregar --}}
{{-- acordarce q las rutas de los articulos se hicieron por defecto asi q no se van a ver en web.php esta te lleva al controlador de articulos del administrador --}}
<form method="POST" action="{{ route('articulos.update',$articulo->id) }}" enctype="multipart/form-data" class="temaFormuEdit">
	@csrf
	{{ method_field('PUT') }}{{-- va ser put porqe se va a actualizar --}}
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
				    <input type="radio" name="activo" value="1" @if((old('activo',$articulo->activo))) checked @endif>
				    	Si
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="activo" value="0" @if(!(old('activo',$articulo->activo))) checked @endif>
				    	No
				  </label>
				</div>
				<hr>
	            <div class="form-group">
	                <label for="exampleInputPassword1">Titulo</label>
	                <input type="text" class="form-control" name="titulo" value="{{ old('titulo',$articulo->titulo) }}">
	            </div>
	            <hr>
	            <div class="form-group">
	                <label for="exampleInputPassword1">Categoria</label>
		            <select class="form-control" name="theme_id">
						@foreach($temasTodos as $tema)
						  <option value="{{ $tema->id }}" {{ old('theme_id', $articulo->theme_id) == $tema->id ? 'selected' : '' }}>{{--old con esto despues de tocar actualizar y por alguna cosa regreso.. theme_id este tema q escogi anteriormente es igual a $articulo->theme_id q viene de la tabla entonce señalamelo si no vacio --}}
					        {{ $tema->nombre }}
					      </option>
				        @endforeach
					</select>
				</div>
				<hr>
				<div class="form-group">
	                <label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido',$articulo->contenido) }}</textarea>{{-- old('contenido' existe esto (existe cuando toqe boton actualizar) si no ponme esto $articulo->contenido --}}
					<script>
				      CKEDITOR.replace( 'contenido' );//este escrip es para q se vea los emoticones y todo eso q se puede agregar
				    </script>
				</div>
				<hr>
				  @foreach($articulo->images as $imagen) {{--$articulo->images obtengo la coleccion de imagenes.. este articulo tiene imagenes hace el bucle para mostrarlas --}}
				    <img width="190px" src="{{ asset('storage/imagenesArticulos/'.$imagen->nombre) }}">{{-- muestra la imagen --}}
				    <a href="{{ route('imagen.delete',$imagen) }}">
				      <img style="margin-left: -26px; margin-top: -170px" width="20px" src="{{asset('imagenes/admin/eliminar.png')}}">{{-- me muestra una imagen de eliminar la crucesita--}}
				    </a>
				@endforeach
				@if($articulo->images->count()<3){{--$articulo->images no le pongo () porqe haria una consulta a la base de datos y gasto recursos para q si ya tengo la coleccion q es como una bolsa q voy metiendo cosas.. entonce si las imagenes q tengo son menores a tres entro al if --}}
				    <p><h3>Añadir imágenes (máximo 3 imágenes por artículo)</h3></p>
                @endif

                {{--si las imagenes q tiene este articulo son menores a 3.. me muestra las veces q faltan para q elijir imagen--}}
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
	            <button type="submit" class="btn btn-info btn-sm">Actualizar</button>
	        </div>
	    </div>
	</div>
</form>
@endsection
