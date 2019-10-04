<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarTitulo">titulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalEliminarEnunciado">Enunciado</p>
            </div>
            <div class="modal-footer">
                <form  id="modalEliminarForm" method="POST">
                    <input id="metodo" value="delete" type="hidden" name="_method">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>