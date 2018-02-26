<script type="text/javascript">
	
$('#formCrearCompra').submit(function (e) {
	e.preventDefault();
	var compra = {};
	var cuentaXPagar = {};
	var items = {};
	var pagos = {};

	$(this).find('.compra input[name]').each(function (i, node) {
		compra[node.name] = node.value;
	});

	$(this).find('.compra select[name]').each(function (i, node) {
		compra[node.name] = node.value;
	});

	$(this).find('#datosCompras input[name]').each(function (i, node) {
		compra[node.name] = node.value;
	});

	$(this).find('.cuentaXPagar input[name]').each(function (i, node) {
		cuentaXPagar[node.name] = node.value;
	});
	cuentaXPagar['tiempo_plazo'] = $(this).find('#selectTiempoPlazo').val();

	items['idProducto'] = idProducto.filter(quitarNull);
	items['idStock'] = idStock.filter(quitarNull);
	items['color'] = color.filter(quitarNull);
	items['cantProducto'] = cantProducto.filter(quitarNull);
	items['precio'] = precio.filter(quitarNull);

	pagos['fecha'] = fecha.filter(quitarNull);
	pagos['idTipoPago'] = idTipoPago.filter(quitarNull);
	pagos['numDocPago'] = numDocPago.filter(quitarNull);
	pagos['montoPago'] = montoPago.filter(quitarNull);

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/compras') }}',
		type: 'POST',
		data: {'compra':compra, 'cuentaXPagar':cuentaXPagar, 'items':items, 'pagos':pagos},
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
			$('#btnGuardar').prop('disabled', true);
			$('#btnGuardar').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			$('.overlay').detach();
			$('#btnGuardar').html('<span class="fa fa-save" aria-hidden="true"></span>');
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			$('#btnGuardar').prop('disabled', false);
			$('#btnGuardar').html('<span class="fa fa-save" aria-hidden="true"></span>');
			mensaje('error', data, '#mensaje');
		}
	});
});

function quitarNull(item) {
	return item != null;
}

</script>