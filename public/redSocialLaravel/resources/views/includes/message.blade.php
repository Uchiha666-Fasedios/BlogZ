@if(session('message'))<?php //si existe la session del mensaje ?>
<div class="alert alert-success">
	{{ session('message') }}
</div>
@endif
