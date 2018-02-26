<div class="modal fade" id="ingresarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title" id="myModalLabel">Ingresar Sucursal</h4>

      </div>

        <form id="guardar" class="form-horizontal">
          <div class="modal-body">

            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="mensajeIngreso"></div>

            <div class="form-group">
              <label for="tipo" class="col-md-2 col-sm-2 control-label">Tipo</label>
              <div class="col-md-7 col-sm-8 col-xs-12">
                <select name="tipo" class="form-control">
                  <option>Sucursal</option>
                  <option>Matriz</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="direccion" class="col-md-2 col-sm-2 col-xs-2 control-label">Dirección</label>
              <div class="col-md-7 col-sm-8 col-xs-12">
                <input class="form-control" type="text" name="direccion">
              </div>
            </div>  

            <div class="form-group">
              <label for="ciudad" class="col-md-2 col-sm-2 col-xs-2 control-label">Ciudad</label>
              <div class="col-md-7 col-sm-8 col-xs-12">
                <input class="form-control" type="text" name="ciudad">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="registrarIngreso" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>