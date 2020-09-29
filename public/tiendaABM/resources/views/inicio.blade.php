@extends('layouts.users')
@section('user-content')
<main class="main">
    

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-9">
                <div class="home-slider owl-carousel owl-carousel-lazy owl-theme owl-theme-light">
                    <div class="home-slide">
                        <div class="owl-lazy slide-bg" data-src="assets/images/slider/slide-1.jpg"></div>
                        <div class="home-slide-content text-white">
                            <h3>Obten <span>60%</span> en</h3>
                            <h1>Todos Smarthphones</h1>
                            <p>Solo durante dos dias.</p>
                            <a href="{{route('productos')}}" class="btn btn-dark">Ir a comprar</a>
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                    <div class="home-slide">
                        <div class="owl-lazy slide-bg" data-src="assets/images/slider/slide-2.jpg"></div>
                        <div class="home-slide-content text-white">
                            <h3>Aprovecha <span>60%</span> de</h3>
                            <h1>Descuento</h1>
                            <p>En todo Eletro.</p>
                            <a href="{{route('productos')}}" class="btn btn-dark">Ir a comprar</a>
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                    <div class="home-slide">
                        <div class="owl-lazy slide-bg" data-src="assets/images/slider/slide-3.jpg"></div>
                        <div class="home-slide-content text-white">
                            <h3>Get up to <span>60%</span> off</h3>
                            <h1>Summer Sale</h1>
                            <p>Limited items available at this price.</p>
                            <a href="{{route('productos')}}" class="btn btn-dark">Ir a comprar</a>
                        </div><!-- End .home-slide-content -->
                    </div><!-- End .home-slide -->
                </div><!-- End .home-slider -->

                <div class="row">
                    @foreach ($best as $item)
                        <div class="col-md-4">
                            <div class="banner banner-image">
                                <a href="#">
                                    <img src="{{asset('poster/'.$item->poster)}}" alt="banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-md-4 -->
                    @endforeach
                    
                   
                </div><!-- End .row -->

                <div class="mb-3"></div><!-- margin -->

                <h2 class="carousel-title">Productos nuevos</h2>

                <div class="home-featured-products owl-carousel owl-theme owl-dots-top">
                    @foreach ($newest as $item)
                        <div class="product-default">
                            <figure>
                                <a href="{{route('producto',$item->slug)}}">
                                    <img src="{{asset('poster/'. $item->poster)}}">
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
                                <div class="product-action">
                                    <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            
                                    <form action="{{route('agregar.carrito')}}" method="POST" style="margin:0 !important">
                                        @csrf
                                        <input type="hidden" name="cantidad" value="1">
                                        <input type="hidden" value="{{$item->id}}" name="idproducto">
                                        <button class="btn-icon btn-add-cart"  type="submit"><i class="icon-bag"></i>AL CARRITO</button>
                                    </form> 
                                </div>
                            </div><!-- End .product-details -->
                        </div>
                    @endforeach
                    
                   
                </div><!-- End .featured-proucts -->

                <div class="mb-6"></div><!-- margin -->
                
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="product-column">
                            <h3 class="title">Best</h3>

                            @foreach ($mejor as $item)
                                <div class="product-default left-details product-widget mb-3">
                                    <figure>
                                        <a href="{{route('producto',$item->slug)}}">
                                            <img src="{{asset('poster/'.$item->poster)}}">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="{{route('producto',$item->slug)}}">{{$item->titulo}}</a>
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
                                        <del>{{$item->precio_antes}}</del>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            @endforeach
                           
                        </div><!-- End .product-column -->
                    </div><!-- End .col-md-4 -->

                    <div class="col-6 col-md-4">
                        <div class="product-column">
                            <h3 class="title">Hot</h3>
                            @foreach ($hot as $item)
                                <div class="product-default left-details product-widget mb-3">
                                    <figure>
                                        <a href="{{route('producto',$item->slug)}}">
                                            <img src="{{asset('poster/'.$item->poster)}}">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="{{route('producto',$item->slug)}}">{{$item->titulo}}</a>
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
                                        <del>{{$item->precio_antes}}</del>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            @endforeach
                            
                           
                        </div><!-- End .product-column -->
                    </div><!-- End .col-md-4 -->

                    <div class="col-6 col-md-4">
                        <div class="product-column">
                            <h3 class="title">Recomendado</h3>

                            @foreach ($reco as $item)
                                <div class="product-default left-details product-widget mb-3">
                                    <figure>
                                        <a href="{{route('producto',$item->slug)}}">
                                            <img src="{{asset('poster/'.$item->poster)}}">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="{{route('producto',$item->slug)}}">{{$item->titulo}}</a>
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
                                        <del>{{$item->precio_antes}}</del>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            @endforeach
                        </div><!-- End .product-column -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->

                <div class="mb-3"></div><!-- margin -->

                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="feature-box feature-box-simple text-center">
                            <i class="icon-star"></i>

                            <div class="feature-box-content">
                                <h3>Dedicated Service</h3>
                                <p>Consult our specialists for help with an order, customization, or design advice</p>
                                <a href="#" class="btn btn-outline-dark">Get in touch</a>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-md-4 -->
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="feature-box feature-box-simple text-center">
                            <i class="icon-reply"></i>

                            <div class="feature-box-content">
                                <h3>Free Returns</h3>
                                <p>We stand behind our goods and services and want you to be satisfied with them.</p>
                                <a href="#" class="btn btn-outline-dark">Return Policy</a>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-md-4 -->

                    <div class="col-sm-6 col-md-4">
                        <div class="feature-box feature-box-simple text-center">
                            <i class="icon-paper-plane"></i>

                            <div class="feature-box-content">
                                <h3>International Shipping</h3>
                                <p>Currently over 50 countries qualify for express international shipping.</p>
                                <a href="#" class="btn btn-outline-dark">Lear More</a>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar-home col-lg-3 order-lg-first">
                <div class="side-menu-container">
                    <h2>MENÚ</h2>

                    <nav class="side-nav">
                        <ul class="menu menu-vertical sf-arrows">
                            <li class="active"><a href="{{route('inicio')}}"><i class="icon-home"></i>Inicio</a></li>
                            <li><a ><i class="icon icon-heart"></i>Ofertas</a></li>
                            <li><a href="{{route('contacto')}}"><i class="icon icon-envolope"></i>Contacto</a></li>
                           
                            <li><a href="{{route('best_seller')}}"><i class="icon icon-star"></i>Lo mas vendido</a></li>
                            <li><a href="https://1.envato.market/DdLk5" target="_blank"><i class="icon-star-empty"></i>Buy devctheme!</a></li>
                        </ul>
                    </nav>
                </div><!-- End .side-menu-container -->
                <?php 
                
                    $config = DB::table('configuraciones')
                    ->first();
                ?>
                <div class="widget widget-banners">
                    <div class="widget-banners-slider owl-carousel owl-theme">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('config/'.$config->banner_inicio_dos)}}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('config/'.$config->banner_inicio_uno)}}" alt="banner">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .banner-slider -->
                </div><!-- End .widget -->

                <div class="widget widget-newsletters">
                    <h3 class="widget-title">Subscribete</h3>
                    <p>Para poder recibir los mejores descuentos. </p>
                    <form action="#">
                        <div class="form-group">
                            <input type="email" class="form-control" id="wemail">
                            <label for="wemail"><i class="icon-envolope"></i>Correo electrónico</label>
                        </div><!-- Endd .form-group -->
                        <input type="submit" class="btn btn-block" value="Registrar correo">
                    </form>
                </div><!-- End .widget -->

                <div class="widget widget-testimonials">
                    <div class="widget-testimonials-slider owl-carousel owl-theme">
                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="assets/images/clients/client1.png" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">john Smith</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div><!-- End .testimonial-owner -->

                            <blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.</p>
                            </blockquote>
                        </div><!-- End .testimonial -->

                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="assets/images/clients/client2.png" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">Dae Smith</h4>
                                    <span>Co-founder</span>
                                </div>
                            </div><!-- End .testimonial-owner -->

                            <blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.</p>
                            </blockquote>
                        </div><!-- End .testimonial -->
                    </div><!-- End .testimonials-slider -->
                </div><!-- End .widget -->

                <div class="widget">
                    <div class="widget-posts-slider owl-carousel owl-theme">
                        <div class="post">
                            <span class="post-date">01- Jun -2018</span>
                            <h4 class="post-title"><a href="#">Fashion News</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
                        </div><!-- End .post -->

                        <div class="post">
                            <span class="post-date">22- May -2018</span>
                            <h4 class="post-title"><a href="#">Shopping News</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non plasasyi. </p>
                        </div><!-- End .post -->

                        <div class="post">
                            <span class="post-date">13- May -2018</span>
                            <h4 class="post-title"><a href="#">Fashion News</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat. </p>
                        </div><!-- End .post -->
                    </div><!-- End .posts-slider -->
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-4"></div><!-- margin -->
</main><!-- End .main -->
@endsection