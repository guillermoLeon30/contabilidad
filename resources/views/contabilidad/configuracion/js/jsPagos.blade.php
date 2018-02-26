<script type="text/javascript">
	
var pagePagos;

$(document).ready(function () {
	generarPagos();
});

$(document).on('click', '#tablaPagos .pagination a', function (e) {
	e.preventDefault();
	pagePagos = $(this).attr('href').split('page=')[1];
	
	generarPagos(pagePagos);
});

function generarPagos(page) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/clsPagos') }}',
		type: 'GET',
		data: {page:page},
		dataType: 'json',
		beforeSend: function () {
            $('#boxPagos .box').append('<div class="overlay">'+
            								'<i class="fa fa-refresh fa-spin"></i>'+
            				 		   '</div>');
        },
		success: function (data) {
			$('#tablaPagos').html(data);
			$('#boxPagos .overlay').detach();
		},
		error: function () {
			$('#boxPagos .overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajePagos');
		}
	});
}

$('#formNuevoPago').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/clsPagos') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formNuevoPago .form-control').prop('disabled', true);
		 	$('#btnGuardarPago').prop('disabled', true);
		 	$('#btnGuardarPago').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalNuevoPago .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formNuevoPago .form-control').prop('disabled', false);
		 	$('#formNuevoPago .form-control').val('');
		 	$('#btnGuardarPago').prop('disabled', false);
		 	$('#btnGuardarPago').html('Ingresar');
		 	$('#modalNuevoPago .cerrar').attr('data-dismiss','modal');
		 	$('#modalNuevoPago').modal('hide');

		 	generarPagos(pagePagos);
		 	mensaje('ok', data, '#mensajePagos');
		},
		error: function (data) {
			$('#formNuevoPago .form-control').prop('disabled', false);
		 	$('#btnGuardarPago').prop('disabled', false);
		 	$('#btnGuardarPago').html('Ingresar');
		 	$('#modalNuevoPago .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalNuevoPago')
		}
	});
});

function editarPago(idClsPago) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/clsPagos') }}/' + idClsPago + '/edit',
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
            $('.box').append('<div class="overlay">'+
            					'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
        },
		success: function (data) {
			$('#idClsPago').val(idClsPago);
			$('#tipoPago').val(data.pago.cuenta);
			$('#modalEditarPago').modal('show');
			$('.overlay').detach();
		},
		error: function () {
			$('.overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajePagos');
		}
	});
}

$('#formEditarPago').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#idClsPago').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/clsPagos') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formEditarPago .form-control').prop('disabled', true);
		 	$('#btnEditarPago').prop('disabled', true);
		 	$('#btnEditarPago').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditarPago .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formEditarPago .form-control').prop('disabled', false);
		 	$('#formEditarPago .form-control').val('');
		 	$('#btnEditarPago').prop('disabled', false);
		 	$('#btnEditarPago').html('Ingresar');
		 	$('#modalEditarPago .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditarPago').modal('hide');

		 	generarPagos(pagePagos);
		 	mensaje('ok', data, '#mensajePagos');
		},
		error: function (data) {
			$('#formEditarPago .form-control').prop('disabled', false);
		 	$('#btnEditarPago').prop('disabled', false);
		 	$('#btnEditarPago').html('Ingresar');
		 	$('#modalEditarPago .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEditarPago')
		}
	});
});

</script>