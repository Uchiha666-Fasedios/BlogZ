@extends('layouts.users')
@section('user-content')
<main class="main">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <h2>Mi perfil</h2>
                
                <form action="{{route('editar_perfil')}}" role="form" method="POST">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        @if(Session::has('success'))
                            <div class="col-sm-11 form-group">
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('danger'))
                        <div class="col-sm-11 form-group">
                            <div class="alert alert-danger">
                                {{Session::get('danger')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-11">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group required-field">
                                        <label for="acc-name">Nombres</label>
                                        <input type="text" class="form-control" id="acc-name" name="name" required value="{{$usuario->name}}" placeholder="Nombres completos">
                                        @if ($errors->has('name'))
                                            <span class="help-block" style="color: #ff0000">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="acc-mname">Apellidos</label>
                                        <input type="text" class="form-control" id="acc-mname" name="fullname" value="{{$usuario->fullname}}" placeholder="Apellidos completos">
                                        @if ($errors->has('fullname'))
                                            <span class="help-block" style="color: #ff0000">{{ $errors->first('fullname') }}</span>
                                        @endif
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-4 -->

                                <div class="col-sm-12 form-group required-field">
                                    <label for="acc-email">Correo electrónico</label>
                                    <input type="email" readonly class="form-control" id="acc-email" required value="{{$usuario->email}}">
                                </div><!-- End .form-group -->

                                <div class="col-sm-6 form-group required-field">
                                    <label for="acc-password">Contrasena nueva</label>
                                    <input type="password" class="form-control" id="acc-password" name="contrasena" autocomplete="new-password" placeholder="Ingrese una nueva contrasena">
                                    @if ($errors->has('password'))
                                        <span class="help-block" style="color: #ff0000">{{ $errors->first('password') }}</span>
                                    @endif
                                </div><!-- End .form-group -->

                                <div class="col-sm-6 form-group required-field">
                                    <label for="acc-password">Confirmación</label>
                                    <input type="password" class="form-control" id="acc-password" name="password_confirmation">
                                </div><!-- End .form-group -->

                                <div class="col-md-6">
                                    <div class="form-group required-field">
                                        <label for="acc-name">Telefono</label>
                                        <input type="number" class="form-control" id="acc-name" name="telefono" required value="{{$usuario->telefono}}" placeholder="Telefono de contacto">
                                        @if ($errors->has('telefono'))
                                            <span class="help-block" style="color: #ff0000">{{ $errors->first('telefono') }}</span>
                                        @endif
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-4 -->

                                <div class="col-md-6">
                                    <div class="form-group required-field">
                                        <label for="acc-name">Tipo de documento</label>
                                        <select name="tipo_doc" class="form-control">
                                            @if ($usuario->tipo_doc == 'DNI')
                                                <option value="DNI" selected>DNI</option>
                                                <option value="Carnet de extrajeria">Carnet de extrajeria</option>
                                            @else
                                                <option value="DNI" >DNI</option>
                                                <option value="Carnet de extrajeria" selected>Carnet de extrajeria</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('tipo_doc'))
                                            <span class="help-block" style="color: #ff0000">{{ $errors->first('tipo_doc') }}</span>
                                        @endif
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-4 -->

                                <div class="col-md-6">
                                    <div class="form-group required-field">
                                        <label for="acc-name">Numero de documento</label>
                                        <input type="number" class="form-control" id="acc-name" name="num_doc" required value="{{$usuario->num_doc}}" placeholder="Numero de documento">
                                        @if ($errors->has('num_doc'))
                                            <span class="help-block" style="color: #ff0000">{{ $errors->first('num_doc') }}</span>
                                        @endif
                                    </div><!-- End .form-group -->
                                </div><!-- End .col-md-4 -->

                                <div class="col-sm-12 mt-4 text-right">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                                
                            </div><!-- End .row -->
                        </div><!-- End .col-sm-11 -->
                    </div><!-- End .row -->
                 
                
                </form>
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">Cuenta</h3>

                    <ul class="list">
                        <li class="active"><a style="background-color: #eee;"><i class="icon icon-user"></i> Mi perfíl</a></li>
                        <li><a href="{{route('direccion')}}"><i class="icon icon-post"></i> Direcciones</a></li>
                    
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div>
    </div>
</main>

@endsection