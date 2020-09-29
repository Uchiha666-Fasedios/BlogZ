@extends('layouts.users')
@section('user-content')
<main class="main">
    <div class="container mt-4">
       
        <?php 
    
                $config = DB::table('configuraciones')
                ->first();
        ?>
        <div class="product-wrapper"><div class="product-intro divide-line up-effect">
            @foreach ($productos as $item)
                <div class="col-6 col-md-3 product-default">
                    <figure>
                        <a href="{{route('producto',$item->slug)}}">
                            <img src="{{asset('poster/'.$item->poster)}}">
                        </a>
                        <!-- <span class="product-label label-sale">27% OFF</span> -->
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="{{route('productos.categoria',$item->categoria)}}" class="product-category">{{$item->categoria}}</a>
                        </div>
                        <h2 class="product-title" style="text-align: center;">
                            <a href="{{route('producto',$item->slug)}}" style="white-space: normal;">{{$item->titulo}}</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
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

        </div>

        <nav class="toolbox toolbox-pagination">
            <div class="toolbox-item toolbox-show">
                <label>Productos mas vendidos</label>
            </div><!-- End .toolbox-item -->

          
        </nav>
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
</div>
</main>

@endsection