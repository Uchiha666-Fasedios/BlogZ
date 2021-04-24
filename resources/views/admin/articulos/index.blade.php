@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	<button type="button" class="btn btn-info"><a href="{{ route('articulos.create') }}">Añadir Nuevo Atículo</a></button>
	<div style="margin-top: 20px">
        <form class="form-inline" action="{{url('admin/buscador/articulos')}}" method="GET">
            @csrf
            <div class="form-group">
            <input type="text" class="form-control" id="exampleInputEmail2" name="busqueda" placeholder="Buscar por tema o usuario">
            </div>
            <button style="margin-top: 8px" type="submit" class="btn btn-warning btn-sm">Buscar</button>
        </form>
    </div>
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
        {{-- me muestra el numero de los articulos q viene de Admin/ArticleController.php--}}
        <strong>{{ $todosArticulos }} articulos</strong>
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
				  	<a href="{{ route('articulos.show',$articulo->id) }}">{{--ACORDARCE Q esta ruta y todas la de los articulos se han añadido por defecto al hacer al controlador resource no se van a ver en web.php--}}
				  		<img width="25px" src="{{ asset('imagenes/admin/ver.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				  <td>
				  	<a href="{{ route('articulos.edit',$articulo->id) }}">{{--articulos.edit este es el nombre de la ruta acordarce q no estan en web.php porqe se crearon por defecto con resource vamos al controlador del articulo del administrador la accion edit--}}
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="title 1" title="title 1">
				  	</a>
				  </td>
				  <td>
                    <form method="POST" action="{{ route('articulos.destroy',$articulo->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        {{-- class="eliminar" pongo el indicador como clase y no como id porqe al ser un bucle se repetiria siempre ese id por cada articuklo y el id tiene q ser unico --}}
                        <button class="eliminar" style=" background-color:white ;border:0" type="submit"> {{--onclick="return confirm('¿Estás Seguro?')"--}}
				  			<img width="25px" src="{{ asset('imagenes/admin/eliminar.png') }}" alt="title 1" title="title 1">
				  		</button>
				  	</form>
				  </td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<div class="row">
    	<div class="col-xs-12 col-lg-10 col-lg-offset-1">
    		{{ $articulos->links() }}
		</div>
	</div>
</div>

@endsection


{{--ELIMINACION CON AXIOS (axios es como ajax)--}}
@section('articulos-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
{{-- lo saqe de https://datatables.net/examples/styling/bootstrap3.html --}}
{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  --}}
@endsection

@section('articulos-js')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
{{-- lo saqe de https://datatables.net/examples/styling/bootstrap3.html --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{------------------------------------------------------------------------}}


<script>
    $(document).ready(function() {

      $('.eliminar').click(function(e){//hago clik en el boton la e vendria ser el submin del formulario
	e.preventDefault();//para q no recarge la pagina , evita q el submin recarge la pagina
        if(!confirm("¿Estás seguro?")){//sale la ventanita de confirm y si es diferente a true (toqe cancelar) me retorna un false si pongo aceptar sigue el codigo
            return false;
        }
		var form=$(this).parents('form');//this hace referencia al elemento .eliminar o sea el boton ..parents('form') cogeme el padre q el padre inmediato del boton es form
        //var url='./admin/eliminar-todos-articulos';
		var url=form.attr('action');//form. entonces del form .. attr('action')cogemos la url atraves del action

        axios.delete(url).then(response =>{ //eliminamos
        //las tostadas para el mensajito de eliminacion fue sacado de https://github.com/CodeSeven/toastr
            toastr.success('El articulo ha sido eliminado','¡Bien!', {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            });//fin de tostada*/
           console.log('todo bien!!');
        }).catch(error => {//si pesca un error
            toastr.error('Error');
        });
            var row= $(this).parents('tr');//this del elemento boton.. parents('tr') cogemos el padre para luego eliminarlo (acordate q cada tr es un articulo porqe esta dentro de un bucle)
        row.fadeOut();//fadeOut() metodo de  jquery ..con esto hacemos q desaparezca de una forma elegante
    });
    });

    </script>
@endsection
