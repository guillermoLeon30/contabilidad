<div class="modal fade" id="modalEditarIVA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Editar porcentaje de retención de IVA</h4>

        <div class="col-xs-12" id="mensajeModalEditarIVA"></div>

      </div>
        
        <form id="formEditarIVA" class="form-horizontal">

          <div class="modal-body">

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Detalle</label>
              <div class="col-sm-10">
                <input type="hidden" id="idRetencionIVA">
                <input id="detalleIVA" type="text" name="detalle" class="form-control">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Porcentaje</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <input id="porcentajeIVA" type="text" name="porcentaje" class="form-control">  
                  <span class="input-group-addon">%</span>
                </div>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEditarIVA" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        
    </div>
  </div>
</div>