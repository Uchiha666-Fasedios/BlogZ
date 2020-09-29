@extends('layouts.admin')
@section('admin')
<div class="main mb-4">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    <i class="fas fa-cog"></i> Configuraciones
                </h1>
                <p class="header-subtitle">Estas configuraciones serán visibles en la tienda para los usuarios!.</p>
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
            
            <form action="{{route('config_save')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
                <div class="row">
                    <div class="col-lg-6 col-md-12 form-group">
                        <div class="card" style="background: #e8e8e8 !important">
                            <div class="card-header">
                                <h5 class="card-title">General</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label><b>Nombre de la tienda</b></label>
                                        <input type="text" required class="form-control" name="titulo" placeholder="Nombre general del ecommerce" value="{{$config->titulo}}">
                                        @if ($errors->has('titulo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('titulo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label><b>Correo de contacto</b></label>
                                        <input type="email" required class="form-control" name="correo" placeholder="Ingrese correo de contacto" value="{{$config->correo}}">
                                        @if ($errors->has('correo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('correo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label><b>Enlace de Facebook</b></label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="background: #385898;color: white;border: none;padding: 0 14px;"><i class="fab fa-facebook-f"></i></div>
                                            </div>
                                            <input type="text" required class="form-control" name="facebook" placeholder="Enlace de facebook" value="{{$config->facebook}}">
                                            @if ($errors->has('facebook'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('facebook') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label><b>Enlace de Twitter</b></label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="background: #00ade5;color: white;border: none;padding: 0 11px;"><i class="fab fa-twitter"></i></div>
                                            </div>
                                            <input type="text"  required class="form-control" name="twitter" placeholder="Enlace de twitter" value="{{$config->twitter}}">
                                            @if ($errors->has('twitter'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('twitter') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 form-group">
                        <div class="card" style="background: #e8e8e8 !important">
                            <div class="card-header">
                                <h5 class="card-title">Contacto</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label><b>Telefono</b></label>
                                        <input type="number" required class="form-control" name="telefono" placeholder="Ingrese telefono de contacto" value="{{$config->telefono}}">
                                        @if ($errors->has('telefono'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label><b>Dirección de la tienda</b></label>
                                        <textarea name="direccion" required placeholder="Dirección física" class="form-control" style="height:80px">{{$config->direccion}}</textarea>
                                        @if ($errors->has('direccion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <label><b>Horarios de atención</b></label>
                                        <textarea name="horario" required placeholder="Dirección física" class="form-control" style="height:80px">{{$config->horario}}</textarea>
                                        @if ($errors->has('horario'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('horario') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 form-group">
                        <div class="card" style="background: #e8e8e8 !important">
                            <div class="card-header">
                                <h5 class="card-title">Mensajes de las compras</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label><b>Mensaje de procesamiento</b></label>
                                        <textarea required name="msm_procesado" class="form-control" style="height:120px" placeholder="Ingrese el mensaje">{{$config->msm_procesado}}</textarea>
                                        @if ($errors->has('msm_procesado'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('msm_procesado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label><b>Mensaje de cancelación</b></label>
                                        <textarea required name="msm_cancelado" class="form-control" style="height:120px" placeholder="Ingrese el mensaje">{{$config->msm_cancelado}}</textarea>
                                        @if ($errors->has('msm_cancelado'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('msm_cancelado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label><b>Mensaje de entrega</b></label>
                                        <textarea required name="msm_entregado" class="form-control" style="height:120px" placeholder="Ingrese el mensaje">{{$config->msm_entregado}}</textarea>
                                        @if ($errors->has('msm_entregado'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('msm_entregado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card" style="background: #e8e8e8 !important">
                            <div class="card-header">
                                <h5 class="card-title">Recursos</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label><b>Logo</b></label>
                                        <input id="imgInp1" type="file" class="form-control mb-4" name="logo">
                                        <img id="blah1" src="{{asset('config/'.$config->logo)}}" style="width:100%">
                                    </div>
                                    <div class="col-lg-3">
                                        <label><b>Banner 1 - página de inicio</b></label>
                                        <input id="imgInp2" type="file" class="form-control mb-4" name="banner_inicio_uno">
                                        <img id="blah2" src="{{asset('config/'.$config->banner_inicio_uno)}}" style="width:100%">
                                    </div>
                                    <div class="col-lg-3">
                                        <label><b>Banner 2 - página de inicio</b></label>
                                        <input id="imgInp3" type="file" class="form-control mb-4" name="banner_inicio_dos">
                                        <img id="blah3" src="{{asset('config/'.$config->banner_inicio_dos)}}"  style="width:100%">
                                    </div>
                                    <div class="col-lg-3">
                                        <label><b>Banner 3 - De detalle de producto</b></label>
                                        <input id="imgInp4" type="file" class="form-control mb-4" name="banner_producto">
                                        <img id="blah4" src="{{asset('config/'.$config->banner_producto)}}"  style="width:100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card" style="background: #e8e8e8 !important">
                            <div class="card-header">
                                <h5 class="card-title">Pagos</h5>
                            </div>
                            <div class="card-body">
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label><b>Tipo de moneda</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="tipo_moneda" class="form-control">
                                            @if ($config->tipo_moneda == 'Soles')
                                                <option value="Soles" selected>Soles</option>
                                                <option value="Dolares">Dolares</option>
                                            @elseif($config->tipo_moneda == 'Dolares')
                                                <option value="Soles" >Soles</option>
                                                <option value="Dolares" selected>Dolares</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label><b>Modo de pagos en Paypal</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="paypal_mode" class="form-control">
                                            @if ($config->paypal_mode == 'sandbox')
                                                <option value="sandbox" selected>sandbox</option>
                                                <option value="production">production</option>
                                            @elseif($config->paypal_mode == 'production')
                                                <option value="sandbox" >sandbox</option>
                                                <option value="production" selected>production</option>
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label><b>Paypal - Client ID Sandbox</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" required class="form-control" name="paypal_client_id" placeholder="Client ID de App en Paypal" value="{{$config->paypal_client_id}}">
                                        @if ($errors->has('paypal_client_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('paypal_client_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label><b>Paypal - Client ID Production</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" required class="form-control" name="paypal_client_id_production" placeholder="Client ID de App en Paypal" value="{{$config->paypal_client_id_production}}">
                                        @if ($errors->has('paypal_client_id_production'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('paypal_client_id_production') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label><b>Culqui - Key Public</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" required class="form-control" name="culqui_key_public" placeholder="Llave publica" value="{{$config->culqui_key_public}}">
                                        @if ($errors->has('culqui_key_public'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('culqui_key_public') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4">
                                        <label><b>Culqui - Key Private</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" required class="form-control" name="culqui_key_private" placeholder="Llave privada" value="{{$config->culqui_key_private}}">
                                        @if ($errors->has('culqui_key_private'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('culqui_key_private') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{asset('img/paypal.png')}}" style="width:100%">
                                <img src="{{asset('img/culqui.jpg')}}" style="width:100%">
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-pen-alt"></i> Actualizar</button>
                    </div>
                </div>
            </form>
            

        </div>
    </main>
    
</div>
@push('scripts')
    <script>

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah1').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp1").change(function() {
            readURL1(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp2").change(function() {
            readURL2(this);
        });

        $("#imgInp1").change(function() {
            readURL1(this);
        });

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah3').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp3").change(function() {
            readURL3(this);
        });

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah4').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp4").change(function() {
            readURL4(this);
        });

    </script>
@endpush
@endsection