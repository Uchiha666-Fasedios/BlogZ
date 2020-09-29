@extends('layouts.users')
@section('user-content')
<main class="main">
    <div class="container">
         
        <?php 
    
                $config = DB::table('configuraciones')
                ->first();
        ?>
        <div class="row mt-4 mb-4">
            <div class="col-lg-8">
                <ul class="checkout-steps">
                    <li>
                        @if(Session::has('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(Session::has('danger'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{Session::get('danger')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <h2 class="step-title" style="padding-bottom:20px;font-weight:300">Detalles de la compra</h2>

                        <div class="shipping-step-addresses">
                            <div class="shipping-address-box active">
                                <address>
                                    <?php echo $venta->direccion?><br>
                                    <p style="margin-bottom: 0px;"><b>País: </b> {{$venta->pais}}</p>
                                    <p style="margin-bottom: 0px;"><b>Región: </b> {{$venta->region}}</p>
                                    <p style="margin-bottom: 0px;"><b>Ciudad: </b> {{$venta->ciudad}}</p>
                                    <p style="margin-bottom: 0px;"><b>ZIP: </b> {{$venta->zip}}</p>
                                </address>

                               
                            </div><!-- End .shipping-address-box -->

                            

                            <div class="shipping-address-box">
                                <address>
                                   <b>Nombres completos: </b>{{auth()->user()->name}} {{auth()->user()->fullname}}<br>
                                   <b>Tipo de documento: </b>{{auth()->user()->tipo_doc}}<br>
                                   <b>Número de documento: </b>{{auth()->user()->num_doc}}<br>
                                   <b>Entrega aproximada: </b>
                                   @if (!$venta->tiempo)
                                       Por actualizar
                                    @else
                                        {{$venta->tiempo}}
                                   @endif
                                   <br>

                                   <b>Número de seguimiento: </b>
                                   @if (!$venta->track)
                                       Por actualizar
                                    @else
                                        {{$venta->track}}
                                   @endif
                                   <br>

                                   <b>Medio postal: </b>
                                   @if (!$venta->medio_postal)
                                       Por actualizar
                                    @else
                                        {{$venta->medio_postal}}
                                   @endif
                                   <br>

                                   <b>Método de págo: </b>{{$venta->metodo}}<br>
                                </address>

                             
                            </div><!-- End .shipping-address-box -->


                            @if ($venta->estado == 'Procesando')
                                <a href="#" class="btn btn-sm btn-outline-secondary btn-new-address mt-4 mr-4" data-toggle="modal" data-target="#confirmacion"><i class="icon icon-ok"></i> Confirmar entrega</a>
                            @endif

                            @if ($venta->estado == 'Entregado')
                                @if (!$resena)
                                    <a href="#" class="btn btn-sm btn-outline-secondary btn-new-address mt-4" data-toggle="modal" data-target="#resena"><i class="icon icon-star"></i> Emitir resena</a>
                                @endif
                            @endif

                            {{-- RESEnA --}}
                            <form action="{{route('emitir_resena')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="resena" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px !important;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel"><b>Resena del producto</b></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" value="{{$venta->idproducto}}" name="idproducto">
                                                <div class="col-lg-12">
                                                    <textarea name="resena" required class="form-control" style="min-height: 90px !important" placeholder="Ingrese su resena, sobre este producto que compró."></textarea>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <label><b>Foto 1</b></label>
                                                    <input id="imgInp1" required name="foto_uno" type="file" class="form-control">
                                                    <img id="blah1" src="{{asset('img/default.png')}}" style="width:100%;height:180px">
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <label><b>Foto 2</b></label>
                                                    <input id="imgInp2" name="foto_dos" type="file" class="form-control">
                                                    <img id="blah2" src="{{asset('img/default.png')}}" style="width:100%;height:180px">
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <label><b>Foto 3</b></label>
                                                    <input id="imgInp3" name="foto_tres" type="file" class="form-control">
                                                    <img id="blah3" src="{{asset('img/default.png')}}" style="width:100%;height:180px">
                                                </div>
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
                            {{-- RESEnA --}}

                            {{-- CONFIMRACION ENTREGA --}}
                            <form action="{{route('confirmar_entraga',$venta->id)}}" method="POST">
                                @csrf
                                <input name="_method" type="hidden" value="PATCH">
                                <div class="modal fade" id="confirmacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px !important;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">Confirmar de entraga</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                    
                                
                                    
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary btn-sm" style="background: #e8a207 !important">Confirmar</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                            {{-- CONFIMRACION ENTREGA --}}

                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">  
                                        <div class="card-body">
                                            @if ($resena)
                                                <h3>Tu resena: </h3>
                                                <p style="margin-bottom:0px">{{$resena->resena}}</p>
                                                <span><b>Fecha: </b>{{$resena->createAt}}</span>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <img src="{{asset('resenas/'.$resena->foto_uno)}}" style="width: 20%;float:left;margin-right:10px">
                                                        <img src="{{asset('resenas/'.$resena->foto_dos)}}" style="width: 20%;float:left;margin-right:10px">
                                                        <img src="{{asset('resenas/'.$resena->foto_tres)}}" style="width: 20%;float:left;margin-right:10px">
                                                    </div>
                                                </div>
                                            @else
                                                <h4>Aun no emitió una resena, lo podrá hacer cuando confirme la entrega.</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div><!-- End .shipping-step-addresses -->
                        
                    </li>


                    
                </ul>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="order-summary">
                    <h3>Producto</h3>

                    <h4>
                        <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">1 producto</a>
                    </h4>

                    <div class="collapse show" id="order-cart-section">
                        <table class="table table-mini-cart">
                            <tbody>
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{asset('poster/'.$venta->poster)}}" alt="product">
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a href="{{route('producto',$venta->slug)}}">{{$venta->titulo}}</a>
                                            </h2>

                                            <span class="product-qty">Cantidad: {{$venta->cantidad}}</span>
                                        </div>
                                    </td>
                                    <td class="price-col">
                                        @if ($config->tipo_moneda == 'Soles')
                                            S/.
                                        @elseif($config->tipo_moneda == 'Dolares')
                                            $
                                        @endif
                                        {{$venta->total}}</td>
                                </tr>

                                
                            </tbody>    
                        </table>
                    </div><!-- End #order-cart-section -->
                </div><!-- End .order-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->

        
    </div><!-- End .container -->
</main>
@push('scripts')
    <script>
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah1').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp1").change(function() {
            readURL1(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp2").change(function() {
            readURL2(this);
        });

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah3').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp3").change(function() {
            readURL3(this);
        });
    </script>
@endpush
@endsection