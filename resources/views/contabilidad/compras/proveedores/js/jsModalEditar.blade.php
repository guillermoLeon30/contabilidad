<script type="text/javascript">
	
function editar(idProveedor) {

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/proveedores') }}/' +idProveedor+'/edit',
		type: 'GET',
		dataType: 'json',
		success: function (data) {
			$('#id').val(data.proveedor.id);
			$('#nombre').val(data.proveedor.nombre_empresa);
			$('#telefono').val(data.proveedor.telefono_convencional);
			$('#correo').val(data.proveedor.correo);
			$('#tipo').val(data.proveedor.tipo);
			$('#descripcion').val(data.proveedor.descripcion);
			$('#direccion').val(data.proveedor.direccion);
			$('#ciudad').val(data.proveedor.ciudad);
			$('#provincia').val(data.proveedor.provincia);
			$('#pais').val(data.proveedor.pais);

			$('#modalEditar').modal('show');			
		},
		error: function (data) {
		 	mensaje2('error', 'Ocurrio un error con la conexión.', '#mensaje')
		}
	});
}

$('#formEditar').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#id').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/proveedores') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formEditar .form-control').prop('disabled', true);
		 	$('#btnEditar').prop('disabled', true);
		 	$('#btnEditar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditar .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#formEditar .form-control').prop('disabled', false);
		 	$('#formEditar .form-control').val('');
		 	$('#btnEditar').prop('disabled', false);
		 	$('#btnEditar').html('Ingresar');
		 	$('#modalEditar .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditar').modal('hide');

		 	generarTabla(page, filtro);
		 	mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#formEditar .form-control').prop('disabled', false);
		 	$('#btnEditar').prop('disabled', false);
		 	$('#btnEditar').html('Ingresar');
		 	$('#modalEditar .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEditar')
		}
	});
});

</script>