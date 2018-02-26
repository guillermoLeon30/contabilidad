<script type="text/javascript">

var pageIVA;

$(document).ready(function () {
	generarTablaIVA();
});

$(document).on('click', '#tablaIVA .pagination a', function (e) {
	e.preventDefault();
	pageIVA = $(this).attr('href').split('page=')[1];
	
	generarTablaIVA(pageIVA);
});

function generarTablaIVA(page) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionIVA') }}',
		type: 'GET',
		data: {page:page},
		dataType: 'json',
		beforeSend: function () {
            $('#boxPorcentajeIVA .box').append('<div class="overlay">'+
            									'<i class="fa fa-refresh fa-spin"></i>'+
            				 				   '</div>');
        },
		success: function (data) {
			$('#tablaIVA').html(data);
			$('#boxPorcentajeIVA .overlay').detach();
		},
		error: function () {
			$('#boxPorcentajeIVA .overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajeRetencionIva');
		}
	});
}

$('#formNuevoIVA').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionIVA') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formNuevoIVA .form-control').prop('disabled', true);
		 	$('#btnGuardarIVA').prop('disabled', true);
		 	$('#btnGuardarIVA').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalNuevoIVA .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formNuevoIVA .form-control').prop('disabled', false);
		 	$('#formNuevoIVA .form-control').val('');
		 	$('#btnGuardarIVA').prop('disabled', false);
		 	$('#btnGuardarIVA').html('Ingresar');
		 	$('#modalNuevoIVA .cerrar').attr('data-dismiss','modal');
		 	$('#modalNuevoIVA').modal('hide');

		 	generarTablaIVA(pageIVA);
		 	mensaje('ok', data, '#mensajeRetencionIva');
		},
		error: function (data) {
			$('#formNuevoIVA .form-control').prop('disabled', false);
		 	$('#btnGuardarIVA').prop('disabled', false);
		 	$('#btnGuardarIVA').html('Ingresar');
		 	$('#modalNuevoIVA .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalNuevoIVA')
		}
	});
});

function editarIVA(idRetencion) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionIVA') }}/' + idRetencion + '/edit',
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
            $('.box').append('<div class="overlay">'+
            					'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
        },
		success: function (data) {
			$('#idRetencionIVA').val(idRetencion);
			$('#detalleIVA').val(data.retencion.detalle);
			$('#porcentajeIVA').val(data.retencion.porcentaje);
			$('#modalEditarIVA').modal('show');
			$('.overlay').detach();
		},
		error: function () {
			$('.overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajeRetencionIva');
		}
	});
}

$('#formEditarIVA').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#idRetencionIVA').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionIVA') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formEditarIVA .form-control').prop('disabled', true);
		 	$('#btnEditarIVA').prop('disabled', true);
		 	$('#btnEditarIVA').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditarIVA .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formEditarIVA .form-control').prop('disabled', false);
		 	$('#formEditarIVA .form-control').val('');
		 	$('#btnEditarIVA').prop('disabled', false);
		 	$('#btnEditarIVA').html('Ingresar');
		 	$('#modalEditarIVA .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditarIVA').modal('hide');

		 	generarTablaIVA(pageIVA);
		 	mensaje('ok', data, '#mensajeRetencionIva');
		},
		error: function (data) {
			$('#formEditarIVA .form-control').prop('disabled', false);
		 	$('#btnEditarIVA').prop('disabled', false);
		 	$('#btnEditarIVA').html('Ingresar');
		 	$('#modalEditarIVA .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEditarIVA')
		}
	});
});

function eliminarIVA(idRetencion) {
	$('#formEliminarIVA #idRetencionIVA').val(idRetencion);
	$('#modalEliminarIVA').modal('show');
}

$('#formEliminarIVA').submit(function (e) {
	e.preventDefault();
	var id = $('#formEliminarIVA #idRetencionIVA').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/retencionIVA') }}/' + id,
		type: 'DELETE',
		dataType: 'json',
		beforeSend: function () {
			$('#formEliminarIVA .form-control').prop('disabled', true);
		 	$('#btnEliminarIVA').prop('disabled', true);
		 	$('#btnEliminarIVA').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEliminarIVA .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formEliminarIVA .form-control').prop('disabled', false);
		 	$('#formEliminarIVA .form-control').val('');
		 	$('#btnEliminarIVA').prop('disabled', false);
		 	$('#btnEliminarIVA').html('Aceptar');
		 	$('#modalEliminarIVA .cerrar').attr('data-dismiss','modal');
		 	$('#modalEliminarIVA').modal('hide');

		 	generarTablaIVA(pageIVA);
		 	mensaje('ok', data, '#mensajeRetencionIva');
		},
		error: function (data) {
			$('#formEliminarIVA .form-control').prop('disabled', false);
		 	$('#btnEliminarIVA').prop('disabled', false);
		 	$('#btnEliminarIVA').html('Aceptar');
		 	$('#modalEliminarIVA .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEliminarIVA')
		}
	});
});

</script>