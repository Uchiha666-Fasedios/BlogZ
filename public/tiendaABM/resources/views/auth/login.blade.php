@extends('layouts.app')

@section('auth')
<main class="main h-100 w-100">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Ecommerce</h1>
                        <p class="lead">
                            Sistema ecommerce con pasarelas de pago
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                {{ csrf_field() }}
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{asset('img/logo.png')}}" alt="Linda Miller" class="img-fluid" width="132" height="132" />
                                    </div>
                           
                                        <div class="form-group">
                                            <label><b>Email</b></label>
                                            <input class="form-control form-control-lg" type="email {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" />
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label><b>Password</b></label>
                                            <input autocomplete="new-password" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" />
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        
                                            <button type="submit" class="btn btn-lg btn-primary">Ingresar</button>
                                        </div>
                              
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
