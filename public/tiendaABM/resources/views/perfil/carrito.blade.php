@extends('layouts.users')
@section('user-content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('inicio')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito de compras</li>
            </ol>
        </div><!-- End .container -->
    </nav>
    <?php 
    
    $config = DB::table('configuraciones')
    ->first();
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if (Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                @endif

                <div class="cart-table-container">
                    @if (count($carrito)>0)
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="product-col">Producto</th>
                                    <th class="price-col">Precio</th>
                                    <th class="qty-col">Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            @foreach ($carrito as $item)
                                <tbody>
                                    <tr class="product-row">
                                        <td class="product-col">
                                            <figure class="product-image-container">
                                                <a href="{{route('productos')}}" class="product-image">
                                                    <img src="{{asset('poster/'.$item->poster)}}" alt="product">
                                                </a>
                                            </figure>
                                            <h2 class="product-title">
                                                <a href="{{route('producto',$item->slug)}}">{{$item->titulo}}</a>
                                            </h2>
                                        </td>
                                        <td>
                                            @if ($config->tipo_moneda == 'Soles')
                                                    S/.
                                                @elseif($config->tipo_moneda == 'Dolares')
                                                    $
                                                @endif
                                            {{$item->precio_ahora}}</td>
                                        <td>
                                            {{$item->cantidad}} uni.
                                        </td>
                                        <td class="total_neto">$<?php echo $item->precio_ahora * $item->cantidad?></td>
                                    </tr>
                                    <tr class="product-action-row">
                                        <td colspan="4" class="clearfix">
                                        
                                            
                                            <div class="float-right">
                                                <form action="{{route('quitar.carrito',$item->id)}}" method="POST" style="margin-bottom: 0px !important; cursor:pointer">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" title="Quitar producto" style="border: none !important;
                                                    background: none !important;" class="btn-remove"><span class="sr-only">Eliminar</span></button>
                                                </form>
                                            </div><!-- End .float-right -->
                                        </td>
                                    </tr>

                                
                                </tbody>
                            @endforeach

                            <tfoot>
                                <tr>
                                    <td colspan="4" class="clearfix">
                                        <div class="float-left">
                                            <a href="{{route('productos')}}" class="btn btn-outline-secondary">Continuar comprando</a>
                                        </div><!-- End .float-left -->

                                    
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <h1 class="mt-4" style="font-weight: 300">Tu carrito está vacio.</h1>
                    @endif
                </div><!-- End .cart-table-container -->

               {{--  <div class="cart-discount">
                    <h4>Apply Discount Code</h4>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"  required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                            </div>
                        </div><!-- End .input-group -->
                    </form>
                </div><!-- End .cart-discount --> --}}
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>Detalles</h3>

                    <h4>
                        <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button" aria-expanded="false" aria-controls="total-estimate-section">ENVIO</a>
                    </h4>

                    <div class="collapse show" id="total-estimate-section">
                        <form action="#">
                            <div class="form-group form-group-sm">
                                <label>Direcciones</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm" id="direccion">
                                        @foreach ($direcciones as $item)
                                            <option value="{{$item->id}}">{{$item->direccion}}</option>
                                        @endforeach                                       
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                           
                        </form>
                    </div><!-- End #total-estimate-section -->

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Total</td>
                                <td>
                                    @if ($config->tipo_moneda == 'Soles')
                                                    S/.
                                                @elseif($config->tipo_moneda == 'Dolares')
                                                    $
                                                @endif
                                    {{$total}}</td>
                            </tr>

                            <tr>
                                <td>Descuento</td>
                                <td>$0.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total a pagar</td>
                                <td>
                                    @if ($config->tipo_moneda == 'Soles')
                                                    S/.
                                                @elseif($config->tipo_moneda == 'Dolares')
                                                    $
                                                @endif
                                    {{$total}}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        
                        @if (count($carrito)>0)
                            <div id="paypal-button-container">                                                                     
                            </div>
                        @else
                            
                        @endif
                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                        
                    </div><!-- End .checkout-methods -->
                    <button id="buyButton" class="btn btn-primary btn-block" style="padding:10px;border: none;background: #dd0d0d"><i class="fas fa-credit-card"></i> Pagar con tarjeta</button>
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main>
@push('scripts')
<script>

    var moneda;

    var total_culqui;

    

    if('<?php echo $config->tipo_moneda?>' == 'Soles'){
        var moneda = 'PEN'; 
    }else if('<?php echo $config->tipo_moneda?>' == 'Dolares'){
        var moneda = 'USD'; 
    }

    if(moneda == 'PEN'){
        total_culqui = parseInt('<?php echo $total?>00') * parseInt('3.35');
    }else if(moneda == 'USD'){
        total_culqui = parseInt('<?php echo $total?>00');
    }

    paypal.Button.render({
    env: '<?php echo $config->paypal_mode?>', 
    style: {

        label: 'paypal',  // checkout | credit | pay | buynow | generic
        size:  'responsive', // small | medium | large | responsive
        shape: 'pill',   // pill | rect
        color: 'gold'   // gold | blue | silver | black
    },


    client: {
        sandbox:    '<?php echo $config->paypal_client_id?>',
        production: '<?php echo $config->paypal_client_id_production?>'
    },

 

    payment: function(data, actions) {
        if('<?php echo $authenticate?>'){

            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total?>', currency: 'USD' },
                            description:"Compras en Devcthemes, TOTAL A PAGAR: <?php echo $total?>USD" ,
                        }
                    ]
                }
            });
        }else{
            window.location.href = "{{URL::to('')}}"
        }
    },

    
    onAuthorize: function(data, actions) {
   
        
        return actions.payment.execute().then(function() {
           
           var productos = '<?php echo $data_productos?>';
           var cantidades = '<?php echo $data_cantidades?>';
           var transanccion  = data.paymentID;
           var codigo = '<?php echo uniqid();?>';
           var direccion = document.getElementById('direccion').value;
           window.location="../../../../venta/checkout/detalles/"+codigo+"/"+transanccion+"/"+productos+"/"+cantidades+"/"+direccion+'/'+'<?php echo $total?>'+'/USD/paypal';

        });
    }

}, '#paypal-button-container');

/***********************************************************************/


Culqi.publicKey = '<?php echo $config->culqui_key_public?>';

  
Culqi.settings({
    title: '<?php echo $config->titulo?>',
    currency: moneda,
    amount: total_culqui,
});
// Usa la funcion Culqi.open() en el evento que desees
$('#buyButton').on('click', function(e) {
    // Abre el formulario con las opciones de Culqi.settings
    Culqi.open();
    e.preventDefault();
});

function culqi() {
  if (Culqi.token) { 
        let token = Culqi.token.id;
        let productos = '<?php echo $data_productos?>';
        let cantidades = '<?php echo $data_cantidades?>';
        let transanccion  = token;
        let codigo = '<?php echo uniqid();?>';
        let direccion = document.getElementById('direccion').value;
  
     return window.location="../../../../venta/checkout/detalles/"+codigo+"/"+transanccion+"/"+productos+"/"+cantidades+"/"+direccion+'/'+total_culqui+'/'+moneda+'/culqi';
  } else { 
      console.log(Culqi.error);
      alert(Culqi.error.user_message);
  }
};
</script>
@endpush
@endsection