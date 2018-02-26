<div class="modal fade" id="modalNuevaCuentaXPagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Nueva Cuenta por pagar</h4>

        <div class="col-xs-12" id="mensajeModalCuentaXPagar"></div>

      </div>
        
        <form id="formNuevaCuentaXPagar" class="form-horizontal">

          <div class="modal-body">

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Cuenta</label>
              <div class="col-sm-10">
                <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                <input type="text" name="cuenta" class="form-control">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnGuardarCtaXPagar" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        
    </div>
  </div>
</div>