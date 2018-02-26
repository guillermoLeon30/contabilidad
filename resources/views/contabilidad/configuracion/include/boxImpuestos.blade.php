<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">Impuestos</h3>
	</div>

	<div id="mensajeImpuestos"></div>

	<form id="formIva" class="form-horizontal">
		<div class="box-body">
			<div class="form-group">
				<label for="ruc" class="col-sm-2 control-label">RUC</label>
				<div class="col-sm-10">
					<input id="ruc" type="number" name="ruc" class="form-control" value="{{ $empresa->ruc }}">
				</div>
			</div>

			<div class="form-group">
				<label for="tipo" class="col-sm-2 control-label">Tipo</label>
				<div class="col-sm-10">
					<select id="tipo" name="tipo" class="form-control">
						<option value="NoObligado">No Obligado a llevar contabilidad</option>
						<option value="Obligado">Obligado a llevar contabilidad</option>
						<option value="Especial">Contrubullente Especial</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="iva" class="col-sm-2 control-label">IVA</label>
				<div class="col-sm-10">
					<div class="input-group">
						<input id="iva" type="number" name="iva" class="form-control" value="{{ $empresa->iva }}">
						<span class="input-group-addon"><strong>%</strong></span>
					</div>
				</div>
			</div>
		</div>

		<div class="box-footer">
			<button id="Guardar" class="btn btn-success" type="submit">Guardar</button>
		</div>
	</form>
</div>