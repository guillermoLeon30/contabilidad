<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th rowspan="3">FECHA</th>
				<th rowspan="3">PROVEEDOR</th>
				<th rowspan="2" colspan="2">FACTURA</th>
				<th rowspan="3">IVA</th>
				<th colspan="4">RETENCIONES</th>
				<th rowspan="3">MONTO NO FACTURADO</th>
				<th rowspan="3">TOTAL</th>
				<th rowspan="3">OPCIONES</th>
			</tr>

			<tr>
				<th colspan="2">IVA</th>
				<th colspan="2">RENTA</th>
			</tr>

			<tr>
				<th>NUMERO</th>
				<th>MONTO</th>
				<th>%</th>
				<th>TOTAL</th>
				<th>%</th>
				<th>TOTAL</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($compras as $compra)
				<tr>
					<td>{{ $compra->fecha() }}</td>
					<td>{{ $compra->proveedor->nombre_empresa }}</td>
					<td>{{ $compra->factura }}</td>
					<td>${{ $compra->monto_facturado }}</td>
					<td>${{ $compra->iva_compra }}</td>
					<td>{{ $compra->porcentaje_retencion_iva }}</td>
					<td>${{ $compra->retencion_iva }}</td>
					<td>{{ $compra->porcentaje_retencion_renta }}</td>
					<td>${{ $compra->retencion_renta }}</td>
					<td>${{ $compra->monto_no_facturado }}</td>
					<td>${{ $compra->total() }}</td>
					<td>
						<button class="btn btn-info" onclick="ver({{ $compra->id }})"><i class="fa fa-eye"></i></button>
						<button class="btn btn-danger" onclick="eliminar({{$compra->id}})"><i class="fa  fa-trash"></i></button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="box-footer">
		{{ $compras->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
	</div>				
</div>