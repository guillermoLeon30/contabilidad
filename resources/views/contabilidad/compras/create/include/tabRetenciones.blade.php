<div class="box box-warning">
	
		<div class="box-body">
			<div class="form-group col-xs-12">
				<label class="col-sm-4 control-label">Porcentaje de retencion de Iva</label>
				<div class="col-sm-8">
					<select id="selectRetencionIva" name="porcentaje_retencion_iva" class="form-control">
						<option value="0"></option>
						@foreach($empresa->retencionesIva as $retencion)
							<option value="{{ $retencion->porcentaje }}">{{ $retencion->detalle }}</option>
						@endforeach
					</select>	
				</div>
			</div>

			<div class="form-group col-xs-12">
				<label class="col-sm-4 control-label">Retencion de Iva</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon">%</span>
						<input id="porcentajeIva" type="text" class="form-control" value="0" disabled>
						<span class="input-group-addon">$</span>
						<input id="retencionIVA" name="retencion_iva" type="text" class="form-control" value="0" disabled>
					</div>
				</div>
			</div>

			<div class="form-group col-xs-12">
				<label class="col-sm-4 control-label">Porcentaje de retencion de Renta</label>
				<div class="col-sm-8">
					<select id="selectRetencionRenta" name="porcentaje_retencion_renta" class="form-control">
						<option value="0"></option>
						@foreach($empresa->retencionesRenta as $retencion)
							<option value="{{ $retencion->porcertaje }}">{{ $retencion->detalle }}</option>
						@endforeach
					</select>	
				</div>
			</div>

			<div class="form-group col-xs-12">
				<label class="col-sm-4 control-label">Retencion de Renta</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon">%</span>
						<input id="porcentajeRenta" type="text" class="form-control" value="0" disabled>
						<span class="input-group-addon">$</span>
						<input id="retencionRenta" name="retencion_renta" type="text" class="form-control" value="0" disabled>
					</div>
				</div>
			</div>
		</div>
	
</div>