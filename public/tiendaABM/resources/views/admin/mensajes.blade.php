@extends('layouts.admin')
@section('admin')
<div class="main mb-4">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    <i class="far fa-envelope"></i> Bandeja de entrada</i> 
                </h1>
                <p class="header-subtitle">Mensajes de usuarios.</p>
            </div>

            @if(Session::has('success'))
                <div class="alert alert-info alert-outline alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{Session::get('success')}}
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            @if(Session::has('danger'))
                <div class="alert alert-danger alert-outline alert-dismissible" role="alert">
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{Session::get('danger')}}
                    </div>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            
            <div class="row mt-4">
                <div class="col-lg-12">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Nombres completos</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        @foreach($mensajes as $item)
                            <tbody>
                                <tr>
                      
                                    <td class="text-center">{{$item->nombres}}</td>
                                    <td class="text-center">{{$item->correo}}</td>
                                    <td class="text-center">{{$item->telefono}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#msm-{{$item->id}}"><i class="fas fa-eye"></i></button>
                                    </td>

                                    <div class="modal fade" id="msm-{{$item->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Mensaje</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
												</div>
												<div class="modal-body m-3">
													<p class="mb-0"><?php echo $item->mensaje?></p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
												
												</div>
											</div>
										</div>
									</div>

                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {{$mensajes->render()}}
                </div>
            </div>
            

        </div>
    </main>
    
</div>

@endsection