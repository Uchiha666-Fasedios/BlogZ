@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	<button type="button" class="btn btn-info"><a href="{{ route('tema.create') }}">Añadir Nuevo Tema</a></button>
	@if(session('notificacion'))
        <div class="alert alert-success" role="alert">
          {{session('notificacion')}}
        </div>
    @endif
    {{-- esta notificacion me lleg de Admin\themeController accion update--}}
    @if(session('notificacion2'))
        <div class="alert alert-success" role="alert">
          {{session('notificacion2')}}
        </div>
    @endif
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Autor</th>
			  <th scope="col">Fecha de creación</th>
			  <th scope="col">Subscripción</th>
			  <th scope="col">Inicio</th>
			  <th scope="col">Editar</th>
			  <th scope="col">Eliminar</th>
			</tr>
		</thead>
		@foreach($temas as $tema)  {{-- desde el controlador de themas me vienen los temas --}}
			<tbody>
				<tr>
				  <th scope="row">{{ $tema->id }}</th>
				  <td>{{ $tema->nombre }}</td>
				  <td>{{ $tema->user->name }}</td>
				  <td>{{ $tema->created_at->diffForHumans() }}</td>
				  <td>{{ $tema->EsSuscripcion }}</td>
				  <td>{{ $tema->EsDestacado }}</td>
				  <td>
                      <a href="{{ route('tema.edit',$tema) }}">
                        {{-- esto nos lleva a un formulario de edicion --}}
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				  <td>

				  	<form method="POST" action="{{ route('tema.delete',$tema) }}">
                        @csrf
                        {{ method_field('DELETE') }} {{-- lleva esto escondido para eliminar porqe por post no es para eliminar  --}}
                        <button style=" background-color:white ;border:0" type="submit" {{-- onclick="return confirm('¿Estás Seguro?') "--}}>
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
