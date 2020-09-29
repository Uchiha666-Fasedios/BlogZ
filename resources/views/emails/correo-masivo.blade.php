{{-- LENGUAJE MARKDOWN --}}
@component('mail::message')
# Noticia Importante
# Hola {{ $usuario->name }}

{{!! $contenido !!}}

@component('mail::button', ['url' => config('app.url') ]){{-- aca pongo un enlace {{ config('app.url')--}}
Ir al blog
@endcomponent

Gracias,<br>
{{ config('app.name') }} {{-- el nombre de nuestra aplicacion --}}
@endcomponent

{{--

<!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Noticia Importante</title>
 </head>
 <body>
     <p><strong>Hola {{ $usuario->name }}</strong></p>
     <p>{{!! $contenido !!}}</p> //mirad esto es mejor.

     <p>
         <a href="{{ url('/') }}">Blog laravel</a>
         <a href="{{ config('app.url') }}">Blog laravel</a>{{-- variable q agarra del archivo .env ..mirando en config/app te das cuenta--}}
{{--
    </p>
 </body>
 </html>

 --}}
