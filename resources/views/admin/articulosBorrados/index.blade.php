@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	@if(session('notificacion'))
        <div class="alert alert-success" role="alert">
          {{session('notificacion')}}
        </div>
    @endif
    @if(session('notificacion2'))
        <div class="alert alert-success" role="alert">
          {{session('notificacion2')}}
        </div>
    @endif
	<div class="row">
        <strong>{{ $articulos->count() }} articulos</strong>
    </div>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Título</th>
			  <th scope="col">Autor</th>
			  <th scope="col">Tema</th>
			  <th scope="col">Fecha de creación</th>
			  <th scope="col">Fecha de eliminación</th>
			  <th scope="col">Activado</th>
			  <th scope="col">Ver Contenido</th>
			  <th scope="col">Restaurar</th>
			  <th scope="col">Eliminar</th>
			</tr>
		</thead>
		@foreach($articulos as $articulo)
			<tbody>
				<tr>
				  <th scope="row">{{ $articulo->id }}</th>
				  <td>{{ $articulo->titulo }}</td>
				  <td>{{ $articulo->user->name }}</td>
				  <td>{{ $articulo->theme->nombre }}</td>
				  <td>{{ $articulo->created_at->toDayDateTimeString() }}</td>
				  <td>{{ $articulo->deleted_at->toDayDateTimeString() }}</td>
				  <td>{{ $articulo->EstaActivado}}</td>
				  <td>
				  	<a href="{{ route('articulos-borrados.show',$articulo->id) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/ver.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				  <td>
				  	<form method="POST" action="{{ route('articulos-borrados.restaurar',$articulo->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <button style=" background-color:white ;border:0" type="submit" onclick="return confirm('¿Estás Seguro?')">
				  			<img width="25px" src="{{ asset('imagenes/admin/restaurar.png') }}" alt="title 1" title="title 1">
				  		</button>
				  	</form>
				  </td>
				  <td>
				  	<form method="POST" action="{{ route('articulos-borrados.destroy',$articulo->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button style=" background-color:white ;border:0" type="submit" onclick="return confirm('¿Estás Seguro?')">
				  			<img width="25px" src="{{ asset('imagenes/admin/eliminar.png') }}" alt="title 1" title="title 1">
				  		</button>
				  	</form>
				  </td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<div class="row">
	</div>
</div>

@endsection
