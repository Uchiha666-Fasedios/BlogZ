@extends('layouts.appAdmin')

@section('content')
<script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
<form method="POST" action="{{ url('admin/correo-masivo') }}" class="temaFormuEdit">
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
	                <label for="exampleInputPassword1">Asunto</label>
	                <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
	            </div>
				<div class="form-group">
	                <label for="exampleInputPassword1">Contenido</label>
					<textarea class="form-control" rows="5" name="contenido">{{ old('contenido') }}</textarea>
					<script>
				      CKEDITOR.replace( 'contenido' );
				    </script>
				</div>
	            <button type="submit" class="btn btn-info btn-sm">Enviar Correos</button>
	        </div>
	    </div>
	</div>
</form>
@endsection