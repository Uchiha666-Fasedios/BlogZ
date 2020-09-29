@extends('layouts.users')
@section('user-content')
<main class="main">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-9">
                <?php 
    
                        $config = DB::table('configuraciones')
                        ->first();
                ?>
                <div class="product-single-container product-single-default">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 product-single-gallery">
                            <div class="product-slider-container product-item">
                                <div class="product-single-carousel owl-carousel owl-theme">
                                    @foreach ($galeria as $item)
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{asset('soporte_img/'.$item->foto)}}" data-zoom-image="{{asset('soporte_img/'.$item->foto)}}"/>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>
                            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                @foreach ($galeria as $item)
                                    <div class="col-3 owl-dot">
                                        <img src="{{asset('soporte_img/'.$item->foto)}}"/>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- End .col-lg-7 -->

                        <div class="col-lg-5 col-md-6">
                            <div class="product-single-details">
                                <h1 class="product-title">{{$producto->titulo}}</h1>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->

                                    <a href="#" class="rating-link">( 6 Reviews )</a>
                                </div><!-- End .product-container -->

                                <div class="price-box">
                                    <span class="old-price">
                                                 @if ($config->tipo_moneda == 'Soles')
                                                    S/.
                                                @elseif($config->tipo_moneda == 'Dolares')
                                                    $
                                                @endif
                                        {{$producto->precio_antes}}</span>
                                    <span class="product-price">

                                        @if ($config->tipo_moneda == 'Soles')
                                            S/.
                                        @elseif($config->tipo_moneda == 'Dolares')
                                            $
                                        @endif
                                        {{$producto->precio_ahora}}</span>
                                </div><!-- End .price-box -->

                                <div class="product-desc">
                                    <p class="text-justify">{{$producto->resena}}</p>
                                </div>

                                <div class="product-desc">
                                    <p class="text-justify" style="margin-bottom: 0 !important"><b>Stock actual: </b>{{$producto->stock}} uni.</p>
                                    @if ($producto->stock < 5)
                                        <p style="color:#ff0000"><b>Quedan pocas unidades!</b></p>
                                    @endif
                                </div>

                                

                               @if (Auth::check())
                                    <form action="{{route('agregar.carrito')}}" method="POST">
                                        @csrf
                                        <div class="product-action product-all-icons">
                                            <div class="product-single-qty">
                                                <input class="horizontal-quantity form-control" name="cantidad" type="text">
                                                <input type="hidden" value="{{$producto->id}}" name="idproducto">
                                            </div>
    
                                            <button type="submit" class="paction add-cart" title="Agregar al carrito" style="cursor: pointer">
                                                <span>AL CARRITO</span>
                                            </button>
                                            
                                            @if (Session::has('danger'))
                                                <p style="color:#ff5579">{{Session::get('danger')}}</p>
                                            @endif
                                            @if (Session::has('success'))
                                                <p style="color:#232f3e "><b>{{Session::get('success')}}</b></p>
                                            @endif
                                            
                                        </div>
                                    </form>
                                @else
                                    <div class="product-action product-all-icons">
                                        <div class="product-single-qty">
                                            <input class="horizontal-quantity form-control" type="text" min="1" max="3">
                                        </div>

                                        <button class="paction add-cart" title="Agregar al carrito" style="cursor: pointer">
                                            <span>AL CARRITO</span>
                                        </button>
                                        
                                        <p style="color:#232f3e "><b>Debe iniciar sesión para comprar.</b></p>
                                    </div>
                                    
                               @endif

                                
                            </div><!-- End .product-single-details -->
                        </div><!-- End .col-lg-5 -->
                    </div><!-- End .row -->
                </div><!-- End .product-single-container -->

                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Detalles</a>
                        </li>
                       {{--  <li class="nav-item">
                            <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Tags</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Resenas</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                               <?php echo $producto->contenido?>
                            </div><!-- End .product-desc-content -->
                        </div><!-- End .tab-pane -->

                        {{-- <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                            <div class="product-tags-content">
                                <form action="#">
                                    <h4>Add Your Tags:</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" required>
                                        <input type="submit" class="btn btn-primary" value="Add Tags">
                                    </div><!-- End .form-group -->
                                </form>
                                <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                            </div><!-- End .product-tags-content -->
                        </div><!-- End .tab-pane --> --}}

                        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                            <div class="product-reviews-content">
                               

                                <div class="add-product-review">
                                    <h3 class="text-uppercase heading-text-color font-weight-semibold">COMENTARIOS</h3>
                                    <p>Solo los usuarios que compraron este producto, pueden comentar.</p>

                                    <div class="row">

                                        @if (count($resenas) == 0)
                                            <div class="col-lg-12">
                                                <p><b>No hay ninguna resena en este producto :(</b></p>
                                            </div>
                                        @else
                                            @foreach ($resenas as $item)
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4>{{$item->name}} {{$item->fullname}}</h4>
                                                            <p style="margin-bottom: 0px !important">{{$item->resena}}</p>
                                                            <span class="text-muted" style="font-size: 1rem;"><b>Fecha de publicación: </b> {{$item->createAt}}</span>
                                                            @if ($item->foto_uno || $item->foto_dos || $item->foto_tres)
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <img src="{{asset('resenas/'.$item->foto_uno)}}" style="width: 100px;float:left;margin-right:10px">
                                                                        <img src="{{asset('resenas/'.$item->foto_dos)}}" style="width: 100px;float:left;margin-right:10px">
                                                                        <img src="{{asset('resenas/'.$item->foto_tres)}}" style="width: 100px;float:left;margin-right:10px">
                                                                    </div>
                                                                
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        
                                    </div>
                                    
                                </div><!-- End .add-product-review -->
                            </div><!-- End .product-reviews-content -->
                        </div><!-- End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-single-tabs -->
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
            <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget widget-brand">
                        <a href="#">
                            <img src="{{asset('assets/images/logo-black.png')}}" alt="brand name">
                        </a>
                    </div><!-- End .widget -->

                    <div class="widget widget-info">
                        <ul>
                            <li>
                                <i class="icon-shipping"></i>
                                <h4>ENVIO<br>GRATIS</h4>
                            </li>
                            <li>
                                <i class="icon-us-dollar"></i>
                                <h4>100% DE GARANTÍA<br>DE TU DINERO</h4>
                            </li>
                            <li>
                                <i class="icon-online-support"></i>
                                <h4>SOPORTE<br> 24/7</h4>
                            </li>
                        </ul>
                    </div><!-- End .widget -->

                    <?php 
                
                        $config = DB::table('configuraciones')
                        ->first();
                    ?>

                    <div class="widget widget-banner">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{asset('config/'.$config->banner_producto)}}" alt="Banner Desc">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Ofertas</h3>
                        
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
                </div>
            </aside><!-- End .col-md-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</main>
@push('scripts')
    <script>
       
    </script>
@endpush
@endsection