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
                            <li class="breadcrumb-item active" aria-current="page">Registro</li>
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-server"></i> Registro</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-tags"></i> Categoría</a>
                            </li>
                          </ul>
                        <div class="tab-content" id="myTabContent">
                            {{--REGISTRO --}}
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form method="POST" action="{{route('store.producto')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mt-4">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="col-lg-9 form-group">
                                                            <label><b>Titulo del producto</b></label>
                                                            <input type="text" name="titulo" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" autocomplete="new-text" placeholder="Titulo del producto" value="{{old('titulo')}}">
                                                            @if ($errors->has('titulo'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('titulo') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-3 form-group">
                                                            <label><b>Categoría</b></label>
                                                            <select name="idcategoria" class="form-control {{ $errors->has('idcategoria') ? ' is-invalid' : '' }}" autocomplete="new-text">
                                                                @foreach ($categorias as $item)
                                                                    <option value="{{$item->id}}">{{$item->titulo}}</option>
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
                                                            <input type="number" name="stock" class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" autocomplete="new-text" value="{{old('stock')}}" placeholder="0">
                                                            @if ($errors->has('stock'))
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('stock') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-3 form-group">
                                                            <label><b>Precio antes</b></label>
                                                            <input type="number" name="precio_antes" class="form-control {{ $errors->has('precio_antes') ? ' is-invalid' : '' }}" autocomplete="new-text" value="{{old('precio_antes')}}" placeholder="0.0">
                                                            @if ($errors->has('precio_antes'))
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('precio_antes') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-3 form-group">
                                                            <label><b>Precio ahora</b></label>
                                                            <input type="number" name="precio_ahora" class="form-control {{ $errors->has('precio_ahora') ? ' is-invalid' : '' }}" autocomplete="new-text" value="{{old('precio_ahora')}}" placeholder="0.0">
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
                                                            <textarea name="resena" class="form-control {{ $errors->has('resena') ? ' is-invalid' : '' }}" placeholder="Redacte una breve descripción" style="height:80px !important">{{old('resena')}}</textarea>
                                                            @if ($errors->has('resena'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('resena') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-12 form-group">
                                                            <textarea name="contenido" id="editor" class="{{ $errors->has('contenido') ? ' is-invalid' : '' }}">{{old('contenido')}}</textarea>
                                                            @if ($errors->has('contenido'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('contenido') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-12 form-group">
                                                            <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-save"></i> Registrar</button>
                                                        </div>
        
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="row">
                                                        <div class="col-lg-12 form-group">
                                                            <div class="text-center">
                                                                <label><b>Portada</b></label>
                                                                <br>
                                                                <img src="{{asset('img/default.png')}}" class=" img-responsive mt-2" id="blah" width="150" height="190">
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
                                                        <div class="col-lg-12 form-group text-center">
                                                            <label><b>Galería</b></label>
                                                            <br>
                                                            <button id="btn_add" class="btn btn-success"><i class="fas fa-image"></i> Nueva imagen</button>
                                                            <hr>
                                                            <div class="row">
                                                            <table id="detalles" class="table table-sm">
                                                                    <thead>
                                                                        <th>Opcion</th>
                                                                        <th>Archivo</th>
                                                                    </thead>
                                                                    <tbody>
                                                                        
                                                                    </tbody>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{--REGISTRO --}}
                            {{--CATEGORIAS --}}
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-12 col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                
                                                <h5 class="card-title">Listado de categorias</h5>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                       <form action="{{route('store.categoria')}}" method="POST" role="form">
                                                        @csrf
                                                            <div class="input-group" id="show_hide_password">
                                                                <input class="form-control" type="text" placeholder="Nueva categoria" name="titulo">
                                                                <input class="form-control" type="text" placeholder="Class de icono" name="icono">
                                                                <div class="input-group-addon">
                                                                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i></button>
                                                                   
                                                                </div>
                                                            </div>
                                                       </form>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Titulo</th>
                                                        <th>Suprimir</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($categorias as $item)
                                                    <tbody>
                                                        <td> {{$item->titulo}}</td>
                                                        
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            
        </div>
    </main>
    
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#btn_add').click(function(){
                agregar();		
            })
        });

        var cont = 0;
        $('#guardar').hide();

        function agregar(){
            var fila ='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+')">X</button></td><td><input required type="file" name="foto[]" class="form-control"></td></tr>'
            cont++;
            $('#detalles').append(fila);
        }


        function eliminar(index){
            $('#fila' + index).remove();
            cont=-1;
        }

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