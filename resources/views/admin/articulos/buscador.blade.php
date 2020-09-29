@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	<div style="margin-top: 20px">
        <form class="form-inline" action="{{url('admin/buscador/articulos')}}" method="GET">
            @csrf
            <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail2" name="busqueda" placeholder="Buscar por tema o usuario">
            </div>
            <button style="margin-top: 8px" type="submit" class="btn btn-warning btn-sm">Buscar</button>
        </form>
    </div>
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
			  <th scope="col">Activado</th>
			  <th scope="col">Ver Contenido</th>
			  <th scope="col">Editar</th>
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
				  <td>{{ $articulo->EstaActivado}}</td>
				  <td>
				  	<a href="{{	route('articulos.show',$articulo->id) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/ver.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				  <td>
				  	<a href="{{ route('articulos.edit',$articulo->id) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				  <td>
				  	<form method="POST" action="{{	route('articulos.destroy',$articulo->id) }}">
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
</div>

@endsection