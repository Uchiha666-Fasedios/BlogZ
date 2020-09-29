@extends('layouts.users')
@section('user-content')
<main class="main">
   
    <?php 
    
    $config = DB::table('configuraciones')
    ->first();
?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12">
                <h2 class="mb-4">Historial de compras</h2>

                @if(Session::has('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{Session::get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead class="thead-dark">
                            <tr>
                                <th style="padding-top:12px !important" class="product-col">Producto</th>
                                <th style="padding-top:12px !important" class="qty-col">Cantidad</th>
                                <th style="padding-top:12px !important" class="price-col">Monto pagado</th>
                                <th style="padding-top:12px !important">Feahc de compra</th>
                                <th style="padding-top:12px !important">Estado</th>
                                <th style="padding-top:12px !important">Acción</th>
                            </tr>
                        </thead>
                        <?php 
                
                            $config = DB::table('configuraciones')
                            ->first();
                        ?>
                        <tbody>
                            @foreach ($ventas as $item)
                                <tr class="product-row">
                                    <td class="product-col">
                                        <figure class="product-image-container" style="max-width: 100px !important;">
                                            <a href="{{route('producto',$item->slug)}}" class="product-image">
                                                <img src="{{asset('poster/'.$item->poster)}}" alt="product">
                                            </a>
                                        </figure>
                                        <h2 class="product-title">
                                            <a href="{{route('producto',$item->slug)}}">{{$item->titulo}}</a>
                                        </h2>
                                    </td>
                                    <td>
                                        {{$item->cantidad}} uni.
                                    </td>
                                    <td>
                                        @if ($config->tipo_moneda == 'Soles')
                                            S/.
                                        @elseif($config->tipo_moneda == 'Dolares')
                                            $
                                        @endif
                                        {{$item->total}}</td>
                                    <td>{{$item->createAt}}</td>
                                    <td>
                                        @if ($item->estado == 'Procesando')
                                            <span id="badge-procesado" class="badge badge-primary" style="padding: 10px;">Procesando</span>
                                            <div class="msm_procesado">
                                                <?php echo $config->msm_procesado?>
                                            </div>
                                        @elseif($item->estado == 'Entregado')
                                            <span id="badge-entregado" class="badge badge-success" style="padding: 10px;">Entregado</span>
                                            <div class="msm_entregado">
                                                <?php echo $config->msm_entregado?>
                                            </div>
                                        @elseif($item->estado == 'Enviado')
                                            <span class="badge badge-success" style="padding: 10px;background: #9f0efa !important">Enviado</span>
                                        @elseif($item->estado == 'Cancelado')
                                            <span id="badge-cancel" class="badge badge-danger" style="padding: 10px;">Cancelado</span>
                                            <div class="msm_cancelacion">
                                                <?php echo $config->msm_cancelado?>
                                            </div>
                                        @elseif($item->estado == 'Reembolsado')
                                            <span class="badge badge-dark" style="padding: 10px;">Reembolsado</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger btn-sm" style="min-width: 30px !important;"><i class="icon icon-cog"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 30px !important;">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                              <a class="dropdown-item" href="{{route('detalleventa',$item->codigo)}}"><i class="icon icon-truck"></i> Detalles de envio</a>
                                              @if ($item->estado == 'Procesando')
                                                <a class="dropdown-item" data-toggle="modal" data-target="#cancelacion-{{$item->id}}"><i class="icon icon-minus-squared"></i> Cancelar compra</a>
                                                
                                              @endif
                                              
                                            </div>
                                          </div>
                                    </td>

                                    {{-- CANCELACION --}}
                                    <form action="{{route('cancelacion')}}" method="POST">
                                        @csrf
                                        <div class="modal fade" id="cancelacion-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px !important;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel"><b>Cancelación de pedido</b></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <textarea name="motivo" required class="form-control" style="min-height: 100px !important" placeholder="Ingrese el motivo de la cancelación."></textarea>
                                                        </div>
                                                        <input type="hidden" value="{{$item->id}}" name="idventa">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary btn-sm" style="background: #e8a207 !important">Enviar</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
            {{-- CANCELACION --}}
                                </tr> 
                            @endforeach
                        </tbody>

                        
                    </table>
                    <hr>
                    {{$ventas->render()}}
                </div><!-- End .cart-table-container -->

                
            </div><!-- End .col-lg-8 -->


            

            
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main>

@endsection