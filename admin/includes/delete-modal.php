<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Estás seguro de eliminar este menú?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccione "Eliminar" a continuación se eliminará <strong>todos</strong> su artículo o menú en esta categoría.</div>
            <div class="modal-footer">
                <form id="deletemenuform" method="POST">
                    <input type="hidden" name="menuID" id="menuid">
                </form>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="deletemenuform" class="btn btn-danger" name="deletemenu">Eliminar</button>
            </div>
        </div>
    </div>
</div>