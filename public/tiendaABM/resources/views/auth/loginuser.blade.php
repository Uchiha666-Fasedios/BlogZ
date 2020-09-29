@extends('layouts.users')
@section('user-content')
<main class="main">
    <div class="container">
        <div class="row" style="margin-top: 50px; margin-bottom: 50px">
            @if(Session::has('success'))
                <div class="col-md-12 form-group">
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <h2 class="title mb-2">Iniciar Sesión</h2>
        
                <form method="POST" action="{{ route('login') }}" class="mb-1" autocomplete="off">
                    @csrf
                    <label for="login-email">Correo Electróninco <span class="required">*</span></label>
                    <input type="email" class="form-input form-wide mb-2" id="login-email" required autocomplete="new-text" name="email">
                        
        
                    <label for="login-password">Contrasena <span class="required">*</span></label>
                    <input type="password" class="form-input form-wide mb-2" id="login-password" required autocomplete="new-password" name="password">

                    @if ($errors->has('email'))
                        <span class="help-block" style="color: #ff0000">{{ $errors->first('email') }}</span><br>
                    @endif
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-md">LOGIN</button>
        
                        
                    </div><!-- End .form-footer -->
                    <a href="#" class="forget-password"> Olvidó su contrasena?</a>
                </form>
            </div><!-- End .col-md-6 -->
        
            <div class="col-md-6">
                <h2 class="title mb-2">Registro rápido</h2>
        
                <form action="{{route('registro.rapido')}}" method="POST" autocomplete="off">
                    @csrf
                    <label for="register-email">Correo Electróninco <span class="required">*</span></label>
                    <input type="email" class="form-input form-wide mb-2" id="register-email" required autocomplete="new-text" name="email">

                        @if ($errors->has('email'))
                            <span class="help-block" style="color: #ff0000">{{ $errors->first('email') }}</span>
                        @endif
        
                    <label for="register-password">Contrasena <span class="required">*</span></label>
                    <input type="password" class="form-input form-wide mb-2" id="register-password" required autocomplete="new-password" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block" style="color: #ff0000">{{ $errors->first('password') }}</span>
                        @endif
        
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-md">Registrar</button>
        
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .col-md-6 -->
        </div>
    </div>
</main>

@endsection