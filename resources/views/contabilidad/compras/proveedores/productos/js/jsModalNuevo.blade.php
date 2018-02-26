<script type="text/javascript">
	
$('#formNuevo').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/proveedores/producto') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formNuevo .form-control').prop('disabled', true);
		 	$('#btnGuardar').prop('disabled', true);
		 	$('#btnGuardar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalNuevo .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#formNuevo .form-control').prop('disabled', false);
		 	$('#formNuevo .form-control').val('');
		 	$('#btnGuardar').prop('disabled', false);
		 	$('#btnGuardar').html('Guardar');
		 	$('#modalNuevo .cerrar').attr('data-dismiss','modal');
		 	$('#modalNuevo').modal('hide');

		 	generarTabla(page, filtro);
		 	mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#formNuevo .form-control').prop('disabled', false);
		 	$('#btnGuardar').prop('disabled', false);
		 	$('#btnGuardar').html('Guardar');
		 	$('#modalNuevo .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalNuevo')
		}
	});
});

</script>