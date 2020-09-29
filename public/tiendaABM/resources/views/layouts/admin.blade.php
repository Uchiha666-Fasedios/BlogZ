<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<?php 
	
	$config = DB::table('configuraciones')
	->first();	
	?>

	<title>PANEL | {{$config->titulo}}</title>

	<style>
		body {
			opacity: 0;
		}
		.hamburger, .hamburger:after, .hamburger:before{
			background: white !important;
		}
	</style>
	<script src="{{asset('js/settings.js')}}"></script>
	<link rel="stylesheet" href="{{asset('css/modern.css')}}">
	<link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>

<body>
	

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="index.html">
                <svg>
                    <use xlink:href="#ion-ios-pulse-strong"></use>
                </svg>
                {{$config->titulo}}
            </a>
			<div class="sidebar-content">
				<div class="sidebar-user" style="background:#b0b0b0; color: white">
					<img src="{{asset('config/'.$config->logo)}}" class="img-fluid  mb-2" alt="Linda Miller" style="width: 80%;"/>
					<div class="font-weight-bold">{{auth()->user()->email}}</div>
					<small>MODO ADMINISTRADOR</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						MENÚ
					</li>
					<li class="sidebar-item">
						<a href="#dashboards" data-toggle="collapse" class="sidebar-link">
							<i class="align-middle mr-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
						</a>

						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('dashboard')}}">Panel</a></li>
							
						</ul>
					</li>
					

					<li class="sidebar-item {{ request()->is('admin/productos') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('index.producto')}}">
							<i class="align-middle mr-2 fas fa-fw fa-heart"></i> <span class="align-middle">Productos</span>
						</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/configuraciones') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('config')}}">
							<i class="align-middle mr-2 fas fa-fw fa-cog"></i> <span class="align-middle">Configuraciones</span>
						</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/ventas/cancelaciones') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{route('cancelaciones')}}">
							<i class="align-middle mr-2 fas fa-fw fa-ban"></i> <span class="align-middle">Cancelaciones</span>
						</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/ventas') ? 'active' : '' }}" >
						<a class="sidebar-link" href="{{route('ventas.admin')}}">
							<i class="align-middle mr-2 fas fa-fw fa-shopping-cart"></i> <span class="align-middle">Ventas</span>
						</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/mensajes') ? 'active' : '' }}" >
						<a class="sidebar-link" href="{{route('mensajes')}}">
							<i class="align-middle mr-2 fas fa-fw fa-envelope"></i> <span class="align-middle">Mensajes</span>
						</a>
					</li>
					
				</ul>
			</div>
		</nav>


		@yield('admin')

	</div>


	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
	@stack('scripts')
    <script>
        tinymce.init({
          selector: '#editor',
          height : "800px",
          language: 'es',
            plugins: [
            'print preview fullpage paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons spellchecker mediaembed pageembed linkchecker powerpaste formatpainter casechange'
            ],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'casechange undo redo  bold italic underline strikethrough  fontselect fontsizeselect formatselect alignleft aligncenter alignright alignjustify outdent indent numlist bullist  forecolor backcolor removeformat pagebreak charmap emoticons fullscreen preview save print insertfile image media template link anchor codesample fullpage ltr rtl styleselect pageembed formatpainter',
            
        });
	</script>
	<style>
		.invalid-feedback{
			display: block;
		}
	</style>
</body>

</html>