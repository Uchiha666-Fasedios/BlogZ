@extends('layouts.admin')
@section('admin')
<div class="main">
    @include('layouts.nav')
    <main class="content">
        <div class="container-fluid">
           
                <div class="header">
                    <h1 class="header-title">
                        Apartado de productos
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('index.producto')}}">Productos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar registro</li>
                        </ol>
                    </nav>
                </div>
            
                <div class="row">
                    @if(Session::has('danger'))
                        <div class="col-lg-12 form-group">
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
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <form method="POST" action="{{route('update.producto',$producto->slug)}}" enctype="multipart/form-data">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mt-4">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-9 form-group">
                                                    <label><b>Titulo del producto</b></label>
                                                    <input type="text" name="titulo" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}"  value="{{$producto->titulo}}">
                                                    @if ($errors->has('titulo'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('titulo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Categoría</b></label>
                                                    <select name="idcategoria" class="form-control {{ $errors->has('idcategoria') ? ' is-invalid' : '' }}" >
                                                        @foreach ($categorias as $item)
                                                            @if ($producto->idcategoria == $item->id)
                                                                <option value="{{$item->id}}" selected>{{$item->titulo}}</option>
                                                            @else
                                                                <option value="{{$item->id}}">{{$item->titulo}}</option>
                                                            @endif   
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('idcategoria'))
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('idcategoria') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Stock</b></label>
                                                    <input type="number" name="stock" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}"  value="{{$producto->stock}}">
                                                    @if ($errors->has('stock'))
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('stock') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Precio antes</b></label>
                                                    <input type="number" name="precio_antes" class="form-control {{ $errors->has('precio_antes') ? ' is-invalid' : '' }}" value="{{$producto->precio_antes}}">
                                                    @if ($errors->has('precio_antes'))
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('precio_antes') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Precio ahora</b></label>
                                                    <input type="number" name="precio_ahora" class="form-control {{ $errors->has('precio_ahora') ? ' is-invalid' : '' }}" value="{{$producto->precio_ahora}}">
                                                    @if ($errors->has('precio_ahora'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('precio_ahora') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Estado</b></label>
                                                    <input type="text" readonly value="ACTIVO" class="form-control">
                                                </div>
                                                <div class="col-lg-12 form-group">
                                                    <textarea name="resena" class="form-control {{ $errors->has('resena') ? ' is-invalid' : '' }}" style="height:80px !important">{{$producto->resena}}</textarea>
                                                    @if ($errors->has('resena'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('resena') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="col-lg-12 form-group">
                                                    <textarea name="contenido" id="editor" class="{{ $errors->has('contenido') ? ' is-invalid' : '' }}">{{$producto->contenido}}</textarea>
                                                    @if ($errors->has('contenido'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('contenido') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-lg-12 form-group">
                                                    <div class="text-center">
                                                        <label><b>Portada</b></label>
                                                        <br>
                                                        <img src="{{asset('poster/'.$producto->poster)}}" class=" img-responsive mt-2" id="blah" width="150" height="190">
                                                        <div class="mt-2">
                                                            <input id="imgInp" class="btn btn-primary" type="file" name="poster" >
                                                        </div>
                                                        <small>For best results, use an image at least 128px by 128px in .jpg
                                                        format</small>
                                                        @if ($errors->has('poster'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('poster') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 text-center">
                                                    <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-save"></i> Actualizar</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            
        </div>
    </main>
    
</div>
@push('scripts')
    <script>
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>
@endpush
@endsection