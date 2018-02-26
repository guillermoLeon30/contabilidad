<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Editar proveedor</h4>

        <div class="col-xs-12" id="mensajeModalEditar"></div>

      </div>
        
        <form id="formEditar" class="form-horizontal">

          <div class="modal-body">

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                <input type="hidden" name="id" id="id">
                <input id="nombre" type="text" name="nombre_empresa" class="form-control">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Telefono</label>
              <div class="col-sm-10">
                <input id="telefono" type="text" name="telefono_convencional" class="form-control">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Correo</label>
              <div class="col-sm-10">
                <input id="correo" type="text" name="correo" class="form-control">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <select class="form-control" name="tipo" id="tipo">
                  <option value="NoObligado">No Obigado a llevar contabilidad</option>
                  <option value="Obligado">Obligado a llevar contabilidad</option>
                  <option value="Especial">Contribuyente especial</option>
                </select>
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Descripción</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="descripcion" id="descripcion"></textarea>
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Dirección</label>
              <div class="col-sm-10">
                <input type="text" name="direccion" class="form-control" id="direccion">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Ciudad</label>
              <div class="col-sm-10">
                <input type="text" name="ciudad" class="form-control" id="ciudad">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Provincia</label>
              <div class="col-sm-10">
                <input type="text" name="provincia" class="form-control" id="provincia">
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Pais</label>
              <div class="col-sm-10">
                <input type="text" name="pais" class="form-control" id="pais">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEditar" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        
    </div>
  </div>
</div>