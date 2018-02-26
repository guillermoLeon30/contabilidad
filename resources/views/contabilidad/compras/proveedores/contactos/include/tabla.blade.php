<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Celular</th>
				<th>Correo</th>
				<th>Cargo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($contactos as $contacto)
				<tr>
					<td>{{ $contacto->nombre }}</td>
					<td>{{ $contacto->telefono }}</td>
					<td>{{ $contacto->celular }}</td>
					<td>{{ $contacto->correo }}</td>
					<td>{{ $contacto->cargo }}</td>
					<td>
						<button class="btn btn-danger" onclick="eliminar({{ $contacto->id }})">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
			@endforeach				
		</tbody>
	</table>

	<div class="box-footer">
		{{ $contactos->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
	</div>				
</div>