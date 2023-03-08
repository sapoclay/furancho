<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Agregar Menú</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="additemform" method="POST">
                    <div class="form-group">
                        <label class="col-form-label">Nombre:</label>
                        <input type="text" required="required" class="form-control" name="itemName" placeholder="Puedes poner algo como Sopa, Pepsi o algo así">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Precio (€):</label>
                        <input type="text" required="required" class="form-control" name="itemPrice">
                        <input type="hidden" name="menuID" id="menuid">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="additemform" class="btn btn-success" name="addItem">Agregar</button>
            </div>
        </div>
    </div>
</div>