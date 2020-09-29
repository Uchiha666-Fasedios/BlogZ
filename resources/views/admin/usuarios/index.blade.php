@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	@if(session('notificacion'))
        <div class="alert alert-success" role="alert">
          {{session('notificacion')}}
        </div>
    @endif
    <div style="margin-top: 20px">
        <form class="form-inline" action="{{ url('admin/buscador/usuarios') }}" method="GET">
            @csrf
            <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail2" name="busqueda" placeholder="Buscar">
            </div>
            <button style="margin-top: 8px" type="submit" class="btn btn-warning btn-sm">Buscar</button>
        </form>
    </div>
	<div class="row">
        <strong>{{ $usuarios->count() }} usuarios</strong>{{-- $usuarios viene del controlador --}}
    </div>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Alias</th>
			  <th scope="col">Rol</th>
			  <th scope="col">Web</th>
			  <th scope="col">Email</th>
			  <th scope="col">Fecha Subscripción</th>
			  <th scope="col">Bloqueado</th>
			  <th scope="col">Editar</th>
			</tr>
		</thead>
		@foreach($usuarios as $key => $usuario)
			<tbody>
				<tr>
				  <th scope="row">{{ $key+1 }}</th>{{-- $key+1 el indice del forichi y como empieza en 0 le pongo el +1 --}}
				  <td>{{ $usuario->name }}</td>
				  <td>{{ $usuario->alias }}</td>
				  <td>{{ $usuario->UsuarioRoles }}</td>{{-- este es un acceso q lo creamos en el modelo User --}}
				  <td>{{ $usuario->web }}</td>
				  <td>{{ $usuario->email }}</td>
				  <td>{{ $usuario->created_at->toDayDateTimeString() }}</td>
				  <td>{{ $usuario->UsuarioBloqueado }}</td>{{-- este es un acceso q lo creamos en el modelo User --}}
				  <td>
				  	<a href="{{ route('usuarios.edit',$usuario) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<div class="row">
    	<div class="col-xs-12 col-lg-10 col-lg-offset-1">
    		{{ $usuarios->links() }}{{-- paginacion --}}
		</div>
	</div>
</div>

@endsection
