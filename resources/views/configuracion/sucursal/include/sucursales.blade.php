<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Código Factura</th>
				<th>Dirección</th>
				<th>Ciudad</th>
				<th>Opciones</th>
			</tr>
		</thead>
			<tbody id="tabla">
				@foreach($sucursales as $sucursal)
					<tr>
						<td>{{$sucursal->tipo}}</td>
						<td>{{$sucursal->codigo_local_factura}}</td>
						<td>{{$sucursal->direccion}}</td>
						<td>{{$sucursal->ciudad}}</td>
						<td>
							<button class="btn btn-info" data-toggle="modal" onclick="mostrar({{$sucursal->id}})">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
							<button class="btn btn-danger" data-toggle="modal" onclick="eliminar({{$sucursal->id}})">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						</td>
					</tr>
				@endforeach
			</tbody>
	</table>
</div>

<div class="box-footer">
	{{ $sucursales->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
</div>