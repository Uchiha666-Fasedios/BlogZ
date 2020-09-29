@extends('layouts.admin')
@section('admin')
<div class="main">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    <i class="fas fa-kaaba"></i> Mis productos
                </h1>
                <p class="header-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, iste!.</p>
            </div>

            <div class="row">
                @if(Session::has('succes'))
                    <div class="col-lg-12 form-group">
                        <div class="alert alert-success alert-outline alert-dismissible" role="alert">
                            <div class="alert-icon">
                                <i class="far fa-fw fa-bell"></i>
                            </div>
                            <div class="alert-message">
                               {{Session::get('succes')}}
                            </div>
        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endif
                
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            
                            <h5 class="card-title">Listado de productos</h5>
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::open(array('url'=>'admin/productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control" type="text" placeholder="Buscar producto" name="buscar" value="{{$buscar}}">
                                        <div class="input-group-addon">
                                          <button class="btn btn-info"><i class="fas fa-search"></i></button>
                                          <a href="{{route('index.producto')}}" class="btn btn-primary"><i class="fas fa-undo-alt"></i></a>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                                <div class="col-lg-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn mb-1 btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Optiones
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 31px, 0px);">
                                            <a class="dropdown-item" href="{{route('create.producto')}}"><i class="fas fa-archive"></i> Registrar producto</a>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Titulo</th>
                                    <th>Precio ahora</th>
                                    <th>Stock</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            @foreach ($productos as $item)
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="{{asset('poster/'.$item->poster)}}" width="48" height="48" class=" mr-2" alt="Avatar"> {{$item->titulo}}
                                    </td>
                                    <td><b>USD</b> {{$item->precio_ahora}}</td>
                                    <td>{{$item->stock}} unidades</td>
                                    <td>
                                        <div class="btn-group">
											<button type="button" class="btn mb-1 btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cog"></i>
                                            </button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="{{route('edit.producto',$item->slug)}}"><i class="fas fa-edit"></i> Editar detalles</a>
												<a class="dropdown-item" data-toggle="modal" data-target="#stock-{{$item->id}}"><i class="fas fa-socks"></i> Aumentar stock</a>
												<a class="dropdown-item" href="{{route('galeria.producto',$item->slug)}}"><i class="fas fa-images"></i> Galería</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}">Eliminar producto</a>
											</div>
                                        </div>
                                        @include('admin.producto.modal')
                                        {{-- Stock --}}
                                        <div class="modal fade" id="stock-{{$item->id}}" tabindex="-1" role="dialog" aria-modal="true" style="padding-right: 16px; display: none;">
                                            <form action="{{route('aumentar_stock.producto',$item->id)}}" method="POST" role="form">
                                                @csrf
                                                <input name="_method" type="hidden" value="PATCH">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Aumentar stock</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body m-3">
                                                            <p class="mb-4"><b>Producto: </b>{{$item->titulo}}, <b>Stock actual: </b> {{$item->stock}} u.</p>
                                                            <input type="number" class="form-control" placeholder="Cantidad para aumento" name="stock">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Aumentar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- Stock --}}
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="col-12 col-xl-12">
                    {{$productos->render()}}
                </div>
            </div>

            

        </div>
    </main>
    
</div>
@endsection