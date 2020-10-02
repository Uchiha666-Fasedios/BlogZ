@extends('layouts.admin')
@section('admin')
<div class="main mb-4">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    <i class="fas fa-shopping-basket"></i> Detalles de la venta
                </h1>
                <p class="header-subtitle">Información detallada de la venta: .</p>
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
            
            <div class="row">
                <div class="col-lg-7 col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h5>Detalles del producto</h5>
                       </div>
                       <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4" style="border-right: 1px solid #bcb8b8;padding-right:18px">
                                    <img src="{{asset('poster/'.$venta->poster)}}" style="width:100%">
                                </div>
                                <div class="col-lg-8">
                                    <h5>{{$venta->titulo}}</h5>
                                    <p style="margin-bottom:0px"><b>Categoría: </b>{{$venta->categoria}}</p>
                                    <p style="margin-bottom:0px"><b>Monto pagado: </b>USD {{$venta->total}}</p>
                                    <p style="margin-bottom:0px"><b>Cantidad: </b>x {{$venta->cantidad}}</p>
                                    <p style="margin-bottom:0px"><b>Código venta: </b> {{strtoupper($venta->codigo)}}</p>
                                    <p style="margin-bottom:0px"><b>Transacción: </b> {{$venta->transaccion}}</p>
                                    <p style="margin-bottom:0px"><b>Método de págo: </b> {{$venta->metodo}}</p>
                                    <p style="margin-bottom:0px"><b>Fecha facturación: </b> {{$venta->fecha}}</p>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Dirección de envio</h5>
                        </div>
                        <div class="card-body">
                            <h5>Dirección de envio principal</h5>
                            <?php echo $venta->direccion?><br>
                            <p style="margin-bottom: 0px;"><b>País: </b> {{$venta->pais}}</p>
                            <p style="margin-bottom: 0px;"><b>Región: </b> {{$venta->region}}</p>
                            <p style="margin-bottom: 0px;"><b>Ciudad: </b> {{$venta->ciudad}}</p>
                            <p style="margin-bottom: 45px;"><b>ZIP: </b> {{$venta->zip}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                   <div class="card">
                       <div class="card-header">
                           <h5>Datos de envio</h5>
                       </div>
                       <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4" style="border-right: 1px solid #bcb8b8;padding-right:18px">
                                    <center><img src="{{asset('img/direccion.png')}}" style="width:80%"></center>
                                </div>
                                <div class="col-lg-8">
                                    
                                    <p style="margin-bottom:0px"><b>Propietario: </b>{{$venta->name}} {{$venta->fullname}}</p>
                                    <p style="margin-bottom:0px"><b>Correo Electrónico: </b>{{$venta->email}}</p>
                                    <p style="margin-bottom:0px"><b>Seguimiento: </b>
                                        @if ($venta->estado == 'Cancelado' || $venta->estado == 'Reembolsado')
                                            &nbsp; <span class="badge badge-danger">Cancelado</span>
                                        @else
                                            @if ($venta->track)
                                                &nbsp; <span class="badge badge-primary">{{$venta->track}}</span>
                                            @else
                                                &nbsp; <span class="badge badge-primary">Procesando</span>
                                            @endif
                                        @endif
                                    </p>
                                    <p style="margin-bottom:0px"><b>Tiempo estimado: </b>
                                        @if ($venta->estado == 'Cancelado' || $venta->estado == 'Reembolsado')
                                            &nbsp; <span class="badge badge-danger">Cancelado</span>
                                        @else
                                            @if ($venta->tiempo)
                                            &nbsp; <span class="badge badge-secondary">{{$venta->tiempo}}</span>
                                            @else
                                            &nbsp; <span class="badge badge-secondary">Procesando</span>
                                            @endif
                                        @endif
                                    </p>
                                    <p style="margin-bottom:0px"><b>Estado del pedido: </b>
                                        @if ($venta->estado)
                                        &nbsp; <span class="badge badge-info">{{$venta->estado}}</span>
                                        @else
                                        &nbsp; <span class="badge badge-info">{{$venta->estado}}</span>
                                        @endif
                                    </p>
                                    <p style="margin-bottom:0px"><b>Médio postal: </b>
                                        @if ($venta->medio_postal)
                                            &nbsp; <span class="badge badge-info">{{$venta->medio_postal}}</span>
                                        @else
                                            &nbsp; <span class="badge badge-warning">Procesando</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
            </div>
            

        </div>
    </main>
    
</div>

@endsection