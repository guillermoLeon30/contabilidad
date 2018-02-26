<div class="modal fade" id="modalEliminarIVA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Eliminar Porcentaje de Retencion de IVA</h4>

        <div class="col-xs-12" id="mensajeModalEliminarIVA"></div>

      </div>
        
        <form id="formEliminarIVA" class="form-horizontal">

          <div class="modal-body">
            <input type="hidden" id="idRetencionIVA">
            ¿Desea eliminar el registro?
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEliminarIVA" type="submit" class="btn btn-primary">Aceptar</button>
          </div>

        </form>
        
    </div>
  </div>
</div>