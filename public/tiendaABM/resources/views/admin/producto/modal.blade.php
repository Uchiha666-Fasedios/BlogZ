<div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form action="{{route('productos.eliminar',$item->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmación de eliminarción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <div class="modal-body">
            
                Desea eliminar definitivamente los datos del producto?
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>&nbsp;
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
        </div>
    </form>
</div>