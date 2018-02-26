<script type="text/javascript">
	
var pageRenta;

$(document).ready(function () {
	generarTablaRenta();
});

$(document).on('click', '#tablaRenta .pagination a', function (e) {
	e.preventDefault();
	pageRenta = $(this).attr('href').split('page=')[1];
	
	generarTablaRenta(pageRenta);
});

function generarTablaRenta(page) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionRenta') }}',
		type: 'GET',
		data: {page:page},
		dataType: 'json',
		beforeSend: function () {
            $('#boxPorcentajeRenta .box').append('<div class="overlay">'+
            										'<i class="fa fa-refresh fa-spin"></i>'+
            				 					 '</div>');
        },
		success: function (data) {
			$('#tablaRenta').html(data);
			$('#boxPorcentajeRenta .overlay').detach();
		},
		error: function () {
			$('#boxPorcentajeRenta .overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajeRetencionRenta');
		}
	});
}

$('#formNuevoRenta').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionRenta') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formNuevoRenta .form-control').prop('disabled', true);
		 	$('#btnGuardarRenta').prop('disabled', true);
		 	$('#btnGuardarRenta').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalNuevaRenta .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formNuevoRenta .form-control').prop('disabled', false);
		 	$('#formNuevoRenta .form-control').val('');
		 	$('#btnGuardarRenta').prop('disabled', false);
		 	$('#btnGuardarRenta').html('Ingresar');
		 	$('#modalNuevaRenta .cerrar').attr('data-dismiss','modal');
		 	$('#modalNuevaRenta').modal('hide');

		 	generarTablaRenta(pageRenta);
		 	mensaje('ok', data, '#mensajeRetencionRenta');
		},
		error: function (data) {
			$('#formNuevoRenta .form-control').prop('disabled', false);
		 	$('#btnGuardarRenta').prop('disabled', false);
		 	$('#btnGuardarRenta').html('Ingresar');
		 	$('#modalNuevaRenta .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalNuevoRenta')
		}
	});
});

function editarRenta(idRetencion) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionRenta') }}/' + idRetencion + '/edit',
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
            $('.box').append('<div class="overlay">'+
            					'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
        },
		success: function (data) {
			$('#idRetancionRenta').val(idRetencion);
			$('#detalleRenta').val(data.retencion.detalle);
			$('#porcentajeRenta').val(data.retencion.porcertaje);
			$('#modalEditarRenta').modal('show');
			$('.overlay').detach();
		},
		error: function () {
			$('.overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajeRetencionRenta');
		}
	});
}

$('#formEditarRenta').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#idRetancionRenta').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionRenta') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formEditarRenta .form-control').prop('disabled', true);
		 	$('#btnEditarRenta').prop('disabled', true);
		 	$('#btnEditarRenta').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditarRenta .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formEditarRenta .form-control').prop('disabled', false);
		 	$('#formEditarRenta .form-control').val('');
		 	$('#btnEditarRenta').prop('disabled', false);
		 	$('#btnEditarRenta').html('Ingresar');
		 	$('#modalEditarRenta .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditarRenta').modal('hide');

		 	generarTablaRenta(pageRenta);
		 	mensaje('ok', data, '#mensajeRetencionRenta');
		},
		error: function (data) {
			$('#formEditarRenta .form-control').prop('disabled', false);
		 	$('#btnEditarRenta').prop('disabled', false);
		 	$('#btnEditarRenta').html('Ingresar');
		 	$('#modalEditarRenta .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEditarRenta')
		}
	});
});

function eliminarRenta(idRetencion) {
	$('#formEliminarRenta #idRetencionRenta').val(idRetencion);
	$('#modalEliminarRenta').modal('show');
}

$('#formEliminarRenta').submit(function (e) {
	e.preventDefault();
	var id = $('#formEliminarRenta #idRetencionRenta').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionRenta') }}/' + id,
		type: 'DELETE',
		dataType: 'json',
		beforeSend: function () {
			$('#formEliminarRenta .form-control').prop('disabled', true);
		 	$('#btnEliminarRenta').prop('disabled', true);
		 	$('#btnEliminarRenta').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEliminarRenta .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formEliminarRenta .form-control').prop('disabled', false);
		 	$('#formEliminarRenta .form-control').val('');
		 	$('#btnEliminarRenta').prop('disabled', false);
		 	$('#btnEliminarRenta').html('Aceptar');
		 	$('#modalEliminarRenta .cerrar').attr('data-dismiss','modal');
		 	$('#modalEliminarRenta').modal('hide');

		 	generarTablaRenta(pageRenta);
		 	mensaje('ok', data, '#mensajeRetencionRenta');
		},
		error: function (data) {
			$('#formEliminarRenta .form-control').prop('disabled', false);
		 	$('#btnEliminarRenta').prop('disabled', false);
		 	$('#btnEliminarRenta').html('Aceptar');
		 	$('#modalEliminarRenta .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEliminarRenta')
		}
	});
});

</script>