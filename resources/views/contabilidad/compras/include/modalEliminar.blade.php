<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Eliminar Compra</h4>

        <div class="col-xs-12" id="mensajeModalEliminar"></div>

      </div>
      
      <form id="formEliminar">
        <div class="modal-body">
            ¿Esta seguro que desea eliminar la compra?
            <input type="hidden" name="compra_id" id="compra_id">
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Eliminar</button>
          <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
        </div>
      </form>

    </div>
  </div>
</div>