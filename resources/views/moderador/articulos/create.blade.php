@extends('layouts.appModerador')

@section('content')
<script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
<form method="POST" action="{{ route('moderador.articulos.store') }}" enctype="multipart/form-data" class="temaFormuEdit">
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
	            <div class="form-group">
	                <label for="exampleInputPassword1">Titulo</label>
	                <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
	            </div>
	            <hr>
	            <div class="form-group">
	                <label for="exampleInputPassword1">Categoria</label>
		            <select class="form-control" name="theme_id">
		              @foreach($temasTodos as $tema)
					  <option value="{{ $tema->id }}" @if(old('theme_id') == $tema->id) selected @endif>{{ $tema->nombre }}</option>
					  @endforeach
					</select>
				</div>
				<hr>
				<div class="form-group">
	                <label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido') }}</textarea>
					<script>
				      CKEDITOR.replace( 'contenido' );
				    </script>
				</div>
				<hr>
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
