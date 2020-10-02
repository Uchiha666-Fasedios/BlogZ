@extends('layouts.app') {{-- heredo todo lo de y me trae todo la q hay y q se este invocando al tocar el esa vista layouts/app.blade.php --}}

{{-- @section se utiliza para modificar el @yield 'title' es el nombre q se le puso al @yield--}}


@section('content')

   <section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 100px; padding-bottom: 100px;">


<div class="container">
    <div  class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('registro-formulario.Register') }}</div>

                {{-- mio validar --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach
                            </ul>
                        </div>
                    @endif
                {{-- mio validar --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>




                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">




                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="alias" class="col-md-4 col-form-label text-md-right">Alias</label>

                            <div class="col-md-6">
                                <input id="alias" type="text" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" name="alias" value="{{ old('alias') }}" placeholder="Min 3, Max 20 carácteres" autocomplete="off" required autofocus> {{--autocomplete="off" para q no se ponga una lista de sugerencias para poner--}}

<div id="alias-alert" style="margin-top:15px; margin-bottom:0px; display:none; background-color:#E8806A" class="alert alert-danger" role="alert">{{--display:none; significa q esta oculto todo esto--}}
                                    Este Alias ya existe en la base de datos, introduce uno nuevo.
                                </div>


                                @if ($errors->has('alias'))
                                    <span class="invalid-feedback" role="alert">
                                         @foreach ($errors->get('alias') as $error)
                                            <li>{{ $error }}</li>
                                         @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="web" class="col-md-4 col-form-label text-md-right">Sitio Web</label>

                            <div class="col-md-6">
                                <input id="web" type="text" class="form-control" name="web" value="{{ old('web') }}" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.Password') }}</label>

                           <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <div id="password-alert" style="margin-top: 15px; margin-bottom: 0px; display:none; background-color:#54B7DA" class="mt-2 alert alert-info" role="alert">
                                    La contraseña debe tener una mayuscula, una minúscula, un número y una longitud mínima de 8 caracteres.<strong>Puede cerrar este mensaje cuando quiera.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('registro-formulario.Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <div id="password-confirm-alert" style="margin-top: 15px; margin-bottom: 0px;display: none; background-color:#E8806A" class="alert alert-danger" role="alert">
                                    No se preocupe, este mensaje desaparecerá cuando las dos password coincidan.
                                </div>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</section>


@endsection





@section('comprobar-alias-js')
    <script>
        var coincidenciaAlias= false;
        var alias;
        var password1;
        var password2;
        $(document).ready(function(){
            $('#alias').keyup(function(){//keyup evento cuando levantamos la tecla
                alias=$(this).val();//se coge el valor del input
                var urlComprobarAlias = '/comprobar-alias-js/' + alias;
                ajax.get(urlComprobarAlias)//axios es como ajax ..recibo la variable
                .then(response => {//aca va la respuesta positiva
                    coincidenciaAlias = response.data;//guardamos la respuesta .. va ser un true o un false
                    if(coincidenciaAlias){//si es true
                        $('#alias-alert').show('slow');//muestro lo q dice el input de este id alias-alert
                    } else {
                        $('#alias-alert').hide('slow');//si ya as sacado el mensaje me ocultas
                    }
                })
                .catch(e => {
                    // Podemos mostrar los errores en la consola
                    console.log(e);
                })
            });

            $('#password').click(function(){
                $('#password-alert').show('slow');
            });

            $('#password-confirm').click(function(){
                password1=$('#password').val();
            });

            $('#password-confirm').keyup(function(){
                password2=$('#password-confirm').val();
                if(password1!=password2){
                    $('#password-confirm-alert').show('slow');
                }else{
                    $('#password-confirm-alert').hide('slow');
                }
            });
        });
    </script>

@include('includes.login-modal')
@if($errors->any())
@section('include-login-modal')
<script src="{{ asset('js/login-modal.js') }}"></script>
@endsection
@endif
@endsection

