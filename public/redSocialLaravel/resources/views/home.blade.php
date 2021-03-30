@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('includes.message')<?php //muestro el mensaje creado en el controlador?>
          @foreach($images as $image)<?php //$images viene del controlador HomeController ?>


       @include('includes.image',['image'=>$image])<?php //me traigo el include donde esta el codigo de esta tarjeta pasandole el parametro de la variable del foreach ['image'=>$image] llevo el parametro $image para poder utilizarlo en el include?>

            @endforeach

            <!--PAGINACION-->
            <div class="clearfix"></div><?php //para limpiar los flotados Un clearfix es una forma para que un elemento a borre automáticamente sus elementos secundarios , para que no necesite agregar marcas adicionales. Generalmente se usa en diseños flotantes donde los elementos se flotan para apilarse horizontalmente.?>

            {{ $images->render() }}<?php //render() este metodo es magico de laravel para la paginacion hoy se usa este?>
            {{-- $images->links() --}}<?php //links() este metodo es magico de laravel para la paginacion ?>


        </div>



    </div>
</div>
@endsection
