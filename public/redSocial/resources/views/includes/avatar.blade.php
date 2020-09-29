
@if(Auth::user()->image){{-- si hay imagen entro --}}
<div class="container-avatar">


		 <!--  <img src="{{ url('/user/avatar/'.Auth::user()->image) }}" alt=""/> --><?php //puede ser asi tambien ?>
													 <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" alt="" class="avatar"><?php //puede ser asi tambien class="avatar" la hoja de style de css esta en public/css la agrege en resources/views/layouts/app.blade.php ahi se agregan los stilos?>
</div>
@endif
