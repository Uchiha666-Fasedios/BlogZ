@extends('layouts.admin')
@section('admin')
<div class="main mb-4">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    <i class="fas fa-hand-holding-usd"></i> Ventas
                </h1>
                <p class="header-subtitle">Ventas generadas.</p>
            </div>

            @if(Session::has('success'))
                <div class="alert alert-info alert-outline alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{Session::get('success')}}
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            @if(Session::has('danger'))
                <div class="alert alert-danger alert-outline alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{Session::get('danger')}}
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            
          
            <div class="row mt-4">
                <div class="col-lg-12">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Nombres completos</th>
                                <th class="text-center">Código de venta</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Método</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        @foreach($ventas as $item)
                            <tbody>
                                <tr>
    
                                    <td class="text-center">{{$item->name}} {{$item->fullname}}</td>
                                    <td class="text-center">{{strtoupper($item->codigo)}}</td>
                                    <td class="text-center">{{$item->fecha}}</td>
                                    <td class="text-center">
                                        @if ($item->estado == 'Procesando')
                                            <span class="badge badge-primary">{{$item->estado}}</span>
                                        @elseif($item->estado == 'Cancelado')
                                            <span class="badge badge-danger">{{$item->estado}}</span>
                                        @elseif($item->estado == 'Enviado')
                                            <span class="badge badge-success">{{$item->estado}}</span>
                                        @elseif($item->estado == 'Entregado')
                                            <span class="badge badge-secondary">{{$item->estado}}</span>
                                        @elseif($item->estado == 'Reembolsado')
                                            <span class="badge badge-dark">{{$item->estado}}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->metodo == 'Paypal')
                                        <i class="fab fa-cc-paypal"></i> {{$item->metodo}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <i class="fas fa-dollar-sign"></i> {{$item->total}}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group show">
											<button type="button" class="btn mb-1 btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fas fa-sliders-h"></i>
                                            </button>
											<div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -172px, 0px);">
												<a class="dropdown-item" href="{{route('detalle_venta.admin',$item->codigo)}}"><i class="fas fa-shopping-basket"></i> Ver detalles</a>
												@if ($item->estado == 'Procesando')
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}"><i class="fas fa-shipping-fast"></i> Aceptar envío</a>
                                                    
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#datos-{{$item->id}}"><i class="fas fa-pallet"></i> Actualzar datos</a>
                                                   
                                                    
                                                @endif
											</div>
										</div>   
                                    </td>

                                    {{-- MODAL --}}
                                    <form action="{{route('aceptar_envio.admin',$item->id)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Aceptar producto enviado</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p class="mb-0">Al aceptar, estas declarando la aceptación de que el producto ya fue enviado.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- MODAL --}}

                                    {{-- MODAL --}}
                                    <form action="{{route('update_datos.admin',$item->id)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div class="modal fade" id="datos-{{$item->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Aceptar producto enviado</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <div class="row">
                                                            <div class="col-lg-12 form-group">
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text" style="background: #00ade5;color: white;border: none;width: 40px;"><i class="fas fa-truck-loading"></i></div>
                                                                    </div>
                                                                    <input type="text" required class="form-control" name="track" placeholder="Número de seguimiento">
                                                                    @if ($errors->has('track'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('track') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 form-group">
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text" style="background: #00ade5;color: white;border: none;width: 40px;"><i class="fas fa-calendar-alt"></i></div>
                                                                    </div>
                                                                    <input type="text"  required class="form-control" name="tiempo" placeholder="Fecha de entrega prevista">
                                                                    @if ($errors->has('tiempo'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('tiempo') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                           
                                                            </div>
                                                            <div class="col-lg-12 form-group">
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text" style="background: #00ade5;color: white;border: none;width: 40px;"><i class="fas fa-truck"></i></div>
                                                                    </div>
                                                                    <input type="text"  required class="form-control" name="medio_postal" placeholder="Medio postal">
                                                                    @if ($errors->has('medio_postal'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('medio_postal') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- MODAL --}}

                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {{$ventas->render()}}
                </div>
            </div>

        </div>
    </main>
    
</div>

@endsection