@extends('layouts.app') {{-- heredo todo lo de y me trae todo la q hay y q se este invocando al tocar el esa vista layouts/app.blade.php --}}

{{-- @section se utiliza para modificar el @yield 'title' es el nombre q se le puso al @yield--}}

@include('includes.login-modal')
@section('content')

   <section class="mbr-section mbr-section-hero news" id="news1-7" data-rv-view="14" style="background-color: rgb(255, 255, 255); padding-top: 100px; padding-bottom: 100px;">



    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    <h3>Contacto</h3>
    ¿Como contactar conmigo?
    <br>
    Dudas y soporte técnico
    <br>
    Habla conmigo
    <br>
    Por estos medios te contestaré y podremos hablar de lo que necesites:
    <br>
    Mándame un mensaje privado en WhatsApp (CONTESTO CASI AL INSTANTE)<br>
    Mándame un mensaje privado en LinkedIn (CONTESTO CASI AL INSTANTE)<br>
    Envíame un mensaje privado en Facebook (SUELO RESPONDER, TARDO ENTRE 2 o 5 DÍAS)<br>
    Por mensaje directo por Instagram (SUELO RESPONDER)<br>
    Escríbeme un mensaje privado por Twitter (PEOR OPCIÓN, PUEDE QUE NO CONTESTE)<br>

    <br>


    📘: <a href="https://api.whatsapp.com/send?phone=5491168460245&amp;text=Hola%20adrian lisciotti,%20tengo%20una%20consulta" target="_blank">whatsapp<img src="{{ asset('images/logos/w.jpg') }}" alt="WhatsApp"></a><br><br>

    👨‍💼: <a href="https://www.linkedin.com/in/adrian-lisciotti-ba82031aa/" target="_blank">LinkedIn<img src="{{ asset('images/logos/in.jpg') }}" alt="LinkedIn"></a><br><br>
    📑: <a href="https://www.facebook.com/adrian.lisciotti" target="_blank">Facebook <img src="{{ asset('images/logos/f.jpg') }}" alt="Facebook"></a><br><br>
    📷: <a href="https://www.instagram.com/adrianlisciotti/" target="_blank">Instagram<img src="{{ asset('images/logos/i.jpg') }}" alt="Instagram"></a><br><br>
    🐦: <a href="https://twitter.com/ALisciotti" target="_blank">Twitter <img src="{{ asset('images/logos/t.png') }}" alt="Twitter"></a><br><br>

            </div>
        </div>
    </div>



 </section>


@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}"></script>
  @endsection
@endif
