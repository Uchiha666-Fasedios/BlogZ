@extends('layouts.admin')
@section('admin')
<div class="main">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Galería de {{$producto->titulo}}
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('index.producto')}}">Productos</a></li>
                    </ol>
                </nav>
                <p class="header-subtitle">Las imagenes a continuacion se mostran, en modo usuario de la tienda!.</p>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#agregar_imagen"><i class="fas fa-image"></i> Agregar imagen</button>



                {{-- AGREGAR --}}
                <div class="modal fade" id="agregar_imagen" tabindex="-1" role="dialog" aria-modal="true" style="padding-right: 16px; display: none;">
                    <form action="{{route('agregar.galeria',$producto->slug)}}" enctype="multipart/form-data" method="POST" role="form">
                        @csrf
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar nueva imagen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body m-3"> 
                                    <input type="file" class="form-control" name="foto">
                                    <input type="hidden" name="idproducto" value="{{$producto->id}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Subir</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- AGREGAR --}}
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

                @if(Session::has('danger'))
                    <div class="col-lg-12 form-group">
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
                    </div>
                @endif
                
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($galeria as $item)
                            <div class="col-lg-3">
                                <div class="card">
                                    <img src="{{asset('soporte_img/'.$item->foto)}}" style="width:100%">
                                    <div class="card-footer text-center">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modal-{{$item->id}}"><i class="fas fa-trash"></i> Suprimir</button>
                                    </div>
                                </div>
                            </div>

                            {{-- ELIMINAR --}}
                            <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-modal="true" style="padding-right: 16px; display: none;">
                                <form action="{{route('destroy.galeria',$item->id)}}" method="POST" role="form">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar imagen</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body m-3">
                                                <p><b>CONFIRMACIÓN!</b>, Al aceptar esta imagen se borrara de sistema.</p>
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-check"></i> Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- ELIMINAR --}}

                        @endforeach
                    </div>
                </div>
                
            </div>

            

        </div>
    </main>
    
</div>
@endsection