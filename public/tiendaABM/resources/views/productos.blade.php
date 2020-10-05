
@extends('layouts.users')
@section('user-content')
<?php
 

if (isset($_GET['quitocolor'])) {
    unset( $_SESSION["color"] );
    header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
    //exit;
}

if (isset($_GET['quitomarca'])) {
    unset( $_SESSION["marca"] );
    header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
//exit;
}

if (isset($_GET['quitocategoria'])) {
    unset( $_SESSION["categoria"] );
    unset( $_SESSION["idCat"] );
    header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
//exit;
}



if (isset($_GET['quitoprice'])) {
    unset( $_SESSION["priceminor"] );
    unset( $_SESSION["pricemajor"] );
    header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
//exit;
}



?>

<main class="main">
    <div class="banner banner-cat" style="background-image: url('assets/images/banners/banner-top.jpg');">
        <div class="banner-content container">
            <h2 class="banner-subtitle">check out over <span>200+</span></h2>
            <h1 class="banner-title">
                INCREDIBLE deals
            </h1>
            <a href="#" class="btn btn-dark">Shop Now</a>
        </div><!-- End .banner-content -->
    </div><!-- End .banner -->

    <?php 
  
            $config = DB::table('configuraciones')
            ->first();
    ?>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-lg-9">
           
                
                <div class="row row-sm">


                <?php 


//unset( $_SESSION["color"] );

if (isset($_GET["color"]) && $_GET["color"] != null) {
$_SESSION['color'] = $_GET["color"];
header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); //lo recargo porqe si no no agarra
//exit;//para q corte y no ejecute lo otro
}

if (isset($_GET["marca"]) && $_GET["marca"] != null) {
$_SESSION['marca'] = $_GET["marca"];
header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
//exit;
}

if (isset($_GET["pminor"]) && $_GET["pminor"] != null && isset($_GET["pmajor"]) && $_GET["pmajor"] != null) {
$_SESSION['priceminor'] = $_GET["pminor"];
$_SESSION['pricemajor'] = $_GET["pmajor"];
header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
//exit;
}

if (isset($_GET["categoria"]) && $_GET["categoria"] != null) {
    $_SESSION['categoria'] = $_GET["categoria"];
    header("Location: http://www.adrianweb.live/tiendaABM/public/productos"); 
    //exit;
    }
               
               
                ?>
                    @foreach ($productos as $item)
                        <div class="col-6 col-md-4">
                            <div class="product-default">
                                <figure>
                                    <a href="{{route('producto',$item->slug)}}">
                                        <img src="{{asset('poster/'.$item->poster)}}">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div><!-- End .product-ratings -->
                                    </div><!-- End .product-container -->
                                    <h2 class="product-title" style="text-align: center;">
                                        <a href="{{route('producto',$item->slug)}}" style="white-space: normal">{{$item->titulo}}</a>
                                    </h2>
                                    <br>

                                    Colores disponibles:
                                <h5 class="product-title">{{$item->color}}</h5>
                                    <div class="price-box">
                                        <span class="product-price">
                                            @if ($config->tipo_moneda == 'Soles')
                                                S/.
                                            @elseif($config->tipo_moneda == 'Dolares')
                                                $
                                            @endif
                                            {{$item->precio_ahora}}</span>
                                        <del>{{$item->precio_antes}}</del>
                                    </div><!-- End .price-box -->
                                    @if (auth::check())
                                        <div class="product-action">
                                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            
                                            <form action="{{route('agregar.carrito')}}" method="POST" style="margin:0 !important">
                                                @csrf
                                                <input type="hidden" name="cantidad" value="1">
                                                <input type="hidden" value="{{$item->id}}" name="idproducto">
                                                <button class="btn-icon btn-add-cart"  type="submit"><i class="icon-bag"></i>AL CARRITO</button>
                                            </form>

                                           
                                        </div>
                                    @endif
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                    @endforeach
                    
               
                </div>

                <nav class="toolbox toolbox-pagination">
                    <div class="toolbox-item toolbox-show">
                        <label>Resultado {{$productos->currentPage()}}–{{$productos->count()}} de 15  productos</label>
                    </div><!-- End .toolbox-item -->

                    <ul class="pagination">
                        {{$productos->render()}}
                    </ul>
                </nav>
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar-shop col-lg-3 order-lg-first">
            <div class="sidebar-wrapper">
                    <?php
if (isset($_SESSION['color']) || isset($_SESSION['categoria']) || isset($_SESSION['pricemajor'])
 || isset($_SESSION['priceminor']) || isset($_SESSION['marca'])) {?>
Quitar filtros

<?php

 } 

                if (isset($_SESSION['color'])) {?>
                    
                    <form action="">
                    
                    <input  class="btn btn-link" style= "color: #F39C12" type="submit" name="quitocolor" value="quitar color <?php echo $_SESSION['color']; ?>">
                    
                </form>
                    
                    
                    
                 <?php 
                }

                if (isset($_SESSION['marca'])) {?>
                    
                    <form>
                    
                    <input  class="btn btn-link" style= "color: #F39C12" type="submit" name="quitomarca" value="quitar marca <?php echo $_SESSION['marca']; ?>">
                    
                </form>
                    
                    
                 <?php 
                }

                if (isset($_SESSION['categoria'])) {?>
                    
                    <form>
                    
                    <input  class="btn btn-link" style= "color: #F39C12"  type="submit" name="quitocategoria" value="quitar categoria <?php echo $_SESSION['categoria']; ?>">
                </form>
                    
                    
                    
                    
                 <?php 
                }

                if (isset($_SESSION['pricemajor']) && isset($_SESSION['priceminor'])) {?>
                    
                    <form>
                    
                    <input  class="btn btn-link" style= "color: #F39C12"  type="submit" name="quitoprice" value="quitar precio <?php echo ' hasta '. $_SESSION['pricemajor']; ?>">
                    
                    </form>
                    
                    
                    
                 <?php 
                } ?>



               
                    <div class="widget">
      

                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">CATEGORIAS</a>
                        </h3>

                        <div class="collapse show" id="widget-body-1">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    @foreach ($categorias as $item)
                                    <?php if (isset($_SESSION['categoria']) || isset($_SESSION['color']) 
                                    || isset($_SESSION['marca']) || isset($_SESSION['priceminor']) || isset($_SESSION['pricemajor'])) { ?>
                                        
                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                        <input type="hidden" name="idCat" value="{{$item->id}}">
                                        <input type="hidden" name="categoriaTitulo" value="{{$item->titulo}}">
                    
                                        <button type="submit" class="btn-marca"><i class="{{$item->icono}}"></i>{{$item->titulo}}</button>
                                        {{Form::close()}}
                                        <?php }else{ ?>

                                        <li><a href="{{route('productos.categoria',strtolower($item->titulo))}}"><i class="{{$item->icono}}"></i> {{$item->titulo}}</a></li>
                                        <?php }?>
                                    @endforeach
                                    
                                    
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Price</a>         
                        </h3>

                        <div class="collapse show" id="widget-body-2">
                            <div class="widget-body">
                                {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                    <div class="price-slider-wrapper">
                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .price-slider-wrapper -->
                                    <input type="hidden" name="pminor" id="pminor" value="{{$pminor}}">
                                    <input type="hidden" name="pmajor" id="pmajor" value="{{$pmajor}}">
                                    <div class="filter-price-action">
                                        <button id="btn-price" type="submit" class="btn btn-primary">Filtrar</button>

                                        <div class="filter-price-text">
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->
                                    </div><!-- End .filter-price-action -->
                                {{Form::close()}}
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">MARCAS</a>
                        </h3>

                        <div class="collapse show" id="widget-body-4">
                            <div class="widget-body">
                                <ul class="cat-list">
                                    <li>
                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="marca" value="adidas">
                                            <button type="submit" class="btn-marca">Adidas</button>
                                        {{Form::close()}}
                                    </li>
                                    <li>
                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="marca" value="xiaomi">
                                            <button type="submit" class="btn-marca">Xiaomi</button>
                                        {{Form::close()}}
                                    </li>
                                    <li>
                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="marca" value="caterpillar">
                                            <button type="submit" class="btn-marca">Caterpillar</button>
                                        {{Form::close()}}
                                    </li>
                                    <li>
                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="marca" value="acer">
                                            <button type="submit" class="btn-marca">Acer</button>
                                        {{Form::close()}}
                                    </li>
                                    <li>
                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="marca" value="huawei">
                                            <button type="submit" class="btn-marca">Huawei</button>
                                        {{Form::close()}}
                                    </li>
                                    
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
                        </h3>

                        <div class="collapse show" id="widget-body-6">
                            <div class="widget-body">
                                <ul class="config-swatch-list">
                                    <li>
                                    

                                        {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="celeste">
                    
                                            <button type="submit" style="background-color: #4090d5; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #4090d5;"></a></button>
                                        {{Form::close()}}
                                        
                                        
                                    </li>
                                   {{-- <li class="active"> --}} 
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="rojo">
                    
                                            <button type="submit" style="background-color: #f5494a; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #f5494a;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="rosa">
                    
                                            <button type="submit" style="background-color: #EC7063; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #EC7063;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>

                                    
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="amarillo">
                    
                                            <button type="submit" style="background-color: #fca309; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #fca309;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="dorado">
                    
                                            <button type="submit" style="background-color: #B9770E; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #B9770E;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="plateado">
                    
                                            <button type="submit" style="background-color: #e3e4e5; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #e3e4e5;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="azul">
                    
                                            <button type="submit" style="background-color: #11426b; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #11426b;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="blanco">
                    
                                            <button type="submit" style="background-color: #FFFFFF; border-width: 1px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #FFFFFF;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="celeste fluo">
                    
                                            <button type="submit" style="background-color: #3fd5c9; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #3fd5c9;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="verde pasto">
                    
                                            <button type="submit" style="background-color: #979c1c; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #979c1c;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="marron">
                    
                                            <button type="submit" style="background-color: #7d5a3c; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #7d5a3c;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="negro">
                    
                                            <button type="submit" style="background-color: #17202A; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #17202A;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="gris">
                    
                                            <button type="submit" style="background-color: #99A3A4; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #99A3A4;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="naranja">
                    
                                            <button type="submit" style="background-color: #BA4A00; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #BA4A00;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="verde">
                    
                                            <button type="submit" style="background-color: #0B5345; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #0B5345;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    <li>
                                    {!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
                                            <input type="hidden" name="color" value="violeta">
                    
                                            <button type="submit" style="background-color: #4A235A; border-width: 0px; border-height: 0px; display: flex; cursor: pointer; width: 2.2rem; height: 2.2rem;" class="btn-color"><a style="background-color: #4A235A;"></a></button>
                                        {{Form::close()}}
                                        
                                    </li>
                                    
                                    
                                </ul>
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">DE TU INTERÉS</h3>
                        
                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                <div class="featured-col">
                                    @foreach ($features as $item)
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="{{route('producto',$item->slug)}}">
                                                <img src="{{asset('poster/'.$item->poster)}}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h2 class="product-title">
                                                <a href="{{route('producto',$item->slug)}}" title="{{$item->titulo}}">{{$item->titulo}}</a>
                                            </h2>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">
                                                    @if ($config->tipo_moneda == 'Soles')
                                                        S/.
                                                    @elseif($config->tipo_moneda == 'Dolares')
                                                        $
                                                    @endif
                                                    {{$item->precio_ahora}}</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                @endforeach
                                    
                                </div><!-- End .featured-col -->

                                
                            </div><!-- End .widget-featured-slider -->
                        </div><!-- End .widget-body -->
                    </div><!-- End .widget -->

                    <div class="widget widget-block">
                        <h3 class="widget-title">Custom HTML Block</h3>
                        <h5>This is a custom sub-title.</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
                    </div><!-- End .widget -->
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</main>
@push('scripts')
    <script>
        
        $(document).ready(function(){
            var t = document.getElementById("price-slider");
            let pminor = $('#pminor').val();
            let pmajor = $('#pmajor').val();

            noUiSlider.create(t, {
                start: [pminor, pmajor],
                connect: !0,
                step: 100,
                margin: 100,
                range: {
                    min: 0,
                    max: 3000
                }
            });
         
            t.noUiSlider.on('update', function (values) {
                $("#filter-price-range").text(values.join(" - "));
            })
            
        });
            
    
        $('#btn-price').click(function(){
            var price = $('#filter-price-range').text();
            var price_array = price.split("-");
            let pminor = parseInt(price_array[0].trim());
            let pmajor = parseInt(price_array[1].trim());
            $('#pminor').val(pminor);
            $('#pmajor').val(pmajor);

            
        });

        
        
    </script>
@endpush
@endsection


