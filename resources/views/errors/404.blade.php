@extends('layouts.app') {{-- heredo todo lo de y me trae todo la q hay y q se este invocando al tocar el esa vista layouts/app.blade.php --}}

@section('content')

<section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 180px; padding-bottom: 3100px;">

    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
            	<p>Esta página no existe, no persista en su error. Fin.</p>
            </div>

        </div>
    </div>
</section>

@include('includes.login-modal') {{-- incluimos el archivo de boostrap del login --}}
@endsection

@if($errors->any()) {{-- si hay un error --}}
  @section('include-login-modal') {{-- hace referencia al @yield q invoco en app.blade.php para q este codigo se ejecute ahi--}}
  <script src="{{ asset('js/login-modal.js') }}"></script>{{-- { asset esto hace q vaya a la carpeta public .. y esto js/login-modal.js hace q valla a carpeta js archivo login-modal.js --}}
  @endsection
@endif






