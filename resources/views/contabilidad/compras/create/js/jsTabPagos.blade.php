<script type="text/javascript">
	
$('#tipoPago').select2({
	dropdownParent: $('#modalIngresarPagos')
});

var contPagos = 0;
var fecha = [];
var idTipoPago = [];
var numDocPago = [];
var montoPago = [];

$('#btnGuardarPago').click(function () {

	if (esValidoIngresarPago()) {
		fecha[contPagos] = $('#fechaPago').val();
		idTipoPago[contPagos] = $('#tipoPago').val();
		var tipo = $('#tipoPago option:selected').html();
		numDocPago[contPagos] = $('#numeroDocumento').val();
		montoPago[contPagos] = $('#montoPago').val();

		var fila = '<tr id="filaPago'+ contPagos +'">'+
						'<td>'+fecha[contPagos]+'</td>'+
						'<td>'+tipo +'</td>'+
						'<td>'+numDocPago[contPagos]+'</td>'+
						'<td>$'+ montoPago[contPagos] +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="eliminarPago('+ contPagos +')">'+
								'<i class="glyphicon glyphicon-trash"></i>'+
							'</button>'+
						'</td>'+
					'</tr>';
		contPagos++;
		$('#tablaPagos').append(fila);
		$('#modalIngresarPagos').modal('hide');
	}
});

function esValidoIngresarPago() {
	var fecha = $('#fechaPago').val();
	var monto = $('#montoPago').val();

	if (monto == 0 || fecha.localeCompare('') == 0) {
		return false;
	}

	return true;
}

function eliminarPago(index) {
	delete fecha[index];
	delete idTipoPago[index];
	delete numDocPago[index];
	delete montoPago[index];

	$('#filaPago'+index).remove();
}

</script>