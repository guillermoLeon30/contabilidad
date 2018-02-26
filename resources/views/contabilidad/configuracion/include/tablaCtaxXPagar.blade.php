<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Cuenta</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($ctasXPagar as $cta)
				<tr>
					<td>{{ $cta->cuenta }}</td>
					<td>
						<button class="btn btn-info" onclick="editarCtaXPagar({{ $cta->id }})">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
			@endforeach	
		</tbody>
	</table>

	<div class="box-footer">
		{{ $ctasXPagar->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
	</div>				
</div>