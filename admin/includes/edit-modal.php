<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Editar Menú</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edititemform" action="edititem.php" method="POST">
                    <div class="form-group">
                        <label class="col-form-label">Nombre:</label>
                        <input type="text" required="required" id="itemname" class="form-control" name="itemName" placeholder="Sopa,Pepsi,etc">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Precio (€):</label>
                        <input type="text" required="required" id="itemprice" class="form-control" name="itemPrice" placeholder="">
                        <input type="hidden" name="menuID" id="menuid">
                        <input type="hidden" name="itemID" id="itemid">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" form="edititemform" class="btn btn-primary" name="btnedit">Editar</button>
            </div>
        </div>
    </div>
</div>