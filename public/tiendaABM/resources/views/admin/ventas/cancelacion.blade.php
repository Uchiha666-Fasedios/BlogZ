@extends('layouts.admin')
@section('admin')
<div class="main mb-4">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    <i class="fas fa-hand-holding-usd"></i> Solicitudes de reembolsos
                </h1>
                <p class="header-subtitle">Solicitudes de reembolsos.</p>
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
                                <th class="text-center">Producto</th>
                                <th class="text-center">Nombres completos</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Método</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        @foreach($cancelaciones as $item)
                            <tbody>
                                <tr>
                                    <td class="text-center">{{$item->producto}}</td>
                                    <td class="text-center">{{$item->name}} {{$item->fullname}}</td>
                                    <td class="text-center">{{$item->fecha}}</td>
                                    <td class="text-center">
                                        @if ($item->estado == 'Pendiente')
                                            <span class="badge badge-primary">{{$item->estado}}</span>
                                        @elseif($item->estado == 'Reembolsado')
                                            <span class="badge badge-danger">{{$item->estado}}</span>
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
												<a class="dropdown-item" data-toggle="modal" data-target="#modal-{{$item->id}}"><i class="fas fa-exclamation-circle"></i> Aceptar reembolso</a>
												
											</div>
										</div>   
                                    </td>

                                    {{-- MODAL --}}
                                    <form action="{{route('cancelaciones.update',$item->codigo)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Aceptar reembolso</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p class="mb-0">Al aceptar, estas declarando la aceptación de la solicitud de reembolso y que ya se emitió el reembolso.</p>
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
                    {{$cancelaciones->render()}}
                </div>
            </div>
            

        </div>
    </main>
    
</div>

@endsection