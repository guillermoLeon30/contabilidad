<div class="modal fade" id="modalIngresarCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Ingresar Categoria</h4>

      </div>

        <form id="formIngresoCategoria" class="form-horizontal">
          <div class="modal-body">

            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" id="mensajeIngresoCategoria"></div>

            <div class="form-group">
              <label for="color" class="col-md-2 col-sm-2 col-xs-2 control-label">Categoria</label>
              <div class="col-md-7 col-sm-8 col-xs-12">
                <input class="form-control" type="text" name="categoria">
              </div>
            </div>  

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngresoCategoria" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>