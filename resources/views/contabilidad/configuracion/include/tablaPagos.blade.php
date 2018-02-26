<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($pagos as $pago)
				<tr>
					<td>{{ $pago->cuenta }}</td>
					<td>
						<button class="btn btn-info" onclick="editarPago({{ $pago->id }})">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
			@endforeach	
		</tbody>
	</table>

	<div class="box-footer">
		{{ $pagos->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
	</div>				
</div>