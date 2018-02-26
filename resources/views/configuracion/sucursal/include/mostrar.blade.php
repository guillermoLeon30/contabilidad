<div class="modal fade" id="mostrarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title" id="myModalLabel">Actualizar Sucursal</h4>

      </div>

        <form id="actualizar" class="form-horizontal">
          <div class="modal-body">

            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="mensajeActualizar"></div>

            <div class="form-group">
              <label for="tipo" class="col-md-2 col-sm-2 control-label">Tipo</label>
              <input type="hidden" id="id" name="id">
              <div class="col-md-7 col-sm-8 col-xs-12">
                <select id="tipo" name="tipo" class="form-control">
                  <option value="Sucursal">Sucursal</option>
                  <option value="Matriz">Matriz</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="direccion" class="col-md-2 col-sm-2 col-xs-2 control-label">Dirección</label>
              <div class="col-md-7 col-sm-8 col-xs-12">
                <input class="form-control" type="text" id="direccion" name="direccion">
              </div>
            </div>  

            <div class="form-group">
              <label for="ciudad" class="col-md-2 col-sm-2 col-xs-2 control-label">Ciudad</label>
              <div class="col-md-7 col-sm-8 col-xs-12">
                <input class="form-control" type="text" id="ciudad" name="ciudad">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="actualizarIngreso" type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
    </div>
  </div>
</div>