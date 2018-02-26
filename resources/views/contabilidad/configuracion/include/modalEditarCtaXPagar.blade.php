<div class="modal fade" id="modalEditarCtaXPagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Editar Cuenta por pagar</h4>

        <div class="col-xs-12" id="mensajeModalEditarCuentaXPagar"></div>

      </div>
        
        <form id="formEditarCuentaXPagar" class="form-horizontal">

          <div class="modal-body">

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Cuenta</label>
              <div class="col-sm-10">
                <input id="ctaXPagar_id" type="hidden">
                <input id="cuentaCuentaXPagar" type="text" name="cuenta" class="form-control">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEditarCtaXPagar" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        
    </div>
  </div>
</div>