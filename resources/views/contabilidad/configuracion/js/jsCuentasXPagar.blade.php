<script type="text/javascript">
	
var pageCtaXPagar;

$(document).ready(function () {
	generarTablaCtaXPagar();
});

$(document).on('click', '#tablaCuentasXPagar .pagination a', function (e) {
	e.preventDefault();
	pageCtaXPagar = $(this).attr('href').split('page=')[1];
	
	generarTablaCtaXPagar(pageCtaXPagar);
});

function generarTablaCtaXPagar(page) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/CtaXPagar') }}',
		type: 'GET',
		data: {page:page},
		dataType: 'json',
		beforeSend: function () {
            $('#boxCuentasXPagar .box').append('<div class="overlay">'+
            									'<i class="fa fa-refresh fa-spin"></i>'+
            				 				   '</div>');
        },
		success: function (data) {
			$('#tablaCuentasXPagar').html(data);
			$('#boxCuentasXPagar .overlay').detach();
		},
		error: function () {
			$('#boxCuentasXPagar .overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajeCuentasXPagar');
		}
	});
}

$('#formNuevaCuentaXPagar').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/CtaXPagar') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formNuevaCuentaXPagar .form-control').prop('disabled', true);
		 	$('#btnGuardarCtaXPagar').prop('disabled', true);
		 	$('#btnGuardarCtaXPagar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalNuevaCuentaXPagar .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formNuevaCuentaXPagar .form-control').prop('disabled', false);
		 	$('#formNuevaCuentaXPagar .form-control').val('');
		 	$('#btnGuardarCtaXPagar').prop('disabled', false);
		 	$('#btnGuardarCtaXPagar').html('Ingresar');
		 	$('#modalNuevaCuentaXPagar .cerrar').attr('data-dismiss','modal');
		 	$('#modalNuevaCuentaXPagar').modal('hide');

		 	generarTablaCtaXPagar(pageCtaXPagar);
		 	mensaje('ok', data, '#mensajeCuentasXPagar');
		},
		error: function (data) {
			$('#formNuevaCuentaXPagar .form-control').prop('disabled', false);
		 	$('#btnGuardarCtaXPagar').prop('disabled', false);
		 	$('#btnGuardarCtaXPagar').html('Ingresar');
		 	$('#modalNuevaCuentaXPagar .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalCuentaXPagar')
		}
	});
});

function editarCtaXPagar(id) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/CtaXPagar') }}/' + id + '/edit',
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
            $('.box').append('<div class="overlay">'+
            					'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
        },
		success: function (data) {
			$('#ctaXPagar_id').val(id);
			$('#cuentaCuentaXPagar').val(data.cuenta.cuenta);
			$('#modalEditarCtaXPagar').modal('show');
			$('.overlay').detach();
		},
		error: function () {
			$('.overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensajeCuentasXPagar');
		}
	});
}

$('#formEditarCuentaXPagar').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#ctaXPagar_id').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/configuracion/CtaXPagar') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#formEditarCuentaXPagar .form-control').prop('disabled', true);
		 	$('#btnEditarCtaXPagar').prop('disabled', true);
		 	$('#btnEditarCtaXPagar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditarCtaXPagar .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			$('#formEditarCuentaXPagar .form-control').prop('disabled', false);
		 	$('#formEditarCuentaXPagar .form-control').val('');
		 	$('#btnEditarCtaXPagar').prop('disabled', false);
		 	$('#btnEditarCtaXPagar').html('Ingresar');
		 	$('#modalEditarCtaXPagar .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditarCtaXPagar').modal('hide');

		 	generarTablaCtaXPagar(pageCtaXPagar);
		 	mensaje('ok', data, '#mensajeCuentasXPagar');
		},
		error: function (data) {
			$('#formEditarCuentaXPagar .form-control').prop('disabled', false);
		 	$('#btnEditarCtaXPagar').prop('disabled', false);
		 	$('#btnEditarCtaXPagar').html('Ingresar');
		 	$('#modalEditarCtaXPagar .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeModalEditarCuentaXPagar')
		}
	});
});

</script>