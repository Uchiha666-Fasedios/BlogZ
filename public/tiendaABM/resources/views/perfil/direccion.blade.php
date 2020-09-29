@extends('layouts.users')
@section('user-content')
<main class="main">
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <h2>Nueva dirección</h2>
                
               <form action="{{route('direccion_registro')}}" role="form" method="POST">
                    @csrf
                    <div class="row">

                        @if(Session::has('success'))
                            <div class="col-sm-12 form-group">
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if(Session::has('danger'))
                        <div class="col-sm-12 form-group">
                            <div class="alert alert-danger">
                                {{Session::get('danger')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        <div class="col-lg-12 form-group">
                            <label><b>Dirección</b></label>
                            <textarea name="direccion" class="form-control" style="min-height: 100px !important;" placeholder="Ingrese su nueva dirección"></textarea>
                        </div>
                        <div class="col-lg-3 col-md-6 form-group">
                            <label><b>País</b></label>
                            <select name="pais" class="form-control">
                                @foreach ($paises as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-6 form-group">
                            <label><b>Región</b></label>
                            <input type="text" class="form-control" placeholder="Región" name="region">
                        </div>
                        <div class="col-lg-3 col-md-6 form-group">
                            <label><b>Ciudad</b></label>
                            <input type="text" class="form-control" placeholder="Ciudad" name="ciudad">
                        </div>
                        <div class="col-lg-3 col-md-6 form-group">
                            <label><b>Código postal</b></label>
                            <input type="text" class="form-control" placeholder="ZIP code" name="zip">
                        </div>
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
                        </div>
                    </div>
               </form>

               <hr>

               <h2>Mis direcciones</h2>

               <div class="row mt-4">

                @foreach ($direcciones as $item)
                    <div class="col-lg-6 form-group">
                        <div class="card">  
                            <div class="card-body">
                                <?php echo $item->direccion?>, <b>ZIP: </b> {{$item->zip}}<br>
                                <span><b>País: </b> {{$item->pais}}</span><br>
                                <span><b>Región: </b> {{$item->region}}</span><br>
                                <span><b>Ciudad: </b> {{$item->ciudad}}</span><br>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-danger btn-sm" style="background: #232f3e !important"
                                data-toggle="modal" data-target="#modal-{{$item->id}}">
                                    Eliminar
                                </button>

                            </div>
                        </div>
                    </div>
                    <form action="{{route('direccion_eliminar',$item->id)}}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px !important;">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="exampleModalLabel">Eliminar dirección</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Desea eliminar definitivamente la dirección?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                  <button type="submit" class="btn btn-primary btn-sm" style="background: #e8a207 !important">Confirmar</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </form>
                @endforeach

               </div>


            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">Cuenta</h3>

                    <ul class="list">
                        <li><a href="{{route('cuenta')}}" style="background-color: #eee;"><i class="icon icon-user"></i> Mi perfíl</a></li>
                        <li class="active"><a><i class="icon icon-post"></i> Direcciones</a></li>
                    
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div>
    </div>
</main>

@endsection