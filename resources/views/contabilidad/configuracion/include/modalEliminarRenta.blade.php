<div class="modal fade" id="modalEliminarRenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Eliminar Porcentaje de Retencion de Renta</h4>

        <div class="col-xs-12" id="mensajeModalEliminarRenta"></div>

      </div>
        
        <form id="formEliminarRenta" class="form-horizontal">

          <div class="modal-body">
            <input type="hidden" id="idRetencionRenta">
            ¿Desea eliminar el registro?
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEliminarRenta" type="submit" class="btn btn-primary">Aceptar</button>
          </div>

        </form>
        
    </div>
  </div>
</div>