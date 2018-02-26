<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Detalle</th>
				<th>Pocentaje</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($retencionesIva as $retencion)
				<tr>
					<td>{{ $retencion->detalle }}</td>
					<td>{{ $retencion->porcentaje }}</td>
					<td>
						<button class="btn btn-info" onclick="editarIVA({{ $retencion->id }})">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
						<button class="btn btn-danger" onclick="eliminarIVA({{ $retencion->id }})">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
			@endforeach	
		</tbody>
	</table>

	<div class="box-footer">
		{{ $retencionesIva->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
	</div>				
</div>