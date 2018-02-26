<script type="text/javascript">
	
function eliminar(compraId) {
	$('#compra_id').val(compraId);
	$('#modalEliminar').modal('show');
}

$('#formEliminar').submit(function (e) {
	e.preventDefault();

	var id = $('#compra_id').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/compras') }}/' + id,
		type: 'DELETE',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
			$('#modalEliminar').modal('hide');
		},
		success: function (data) {
			$('#tabla').html('');
			$('.overlay').detach();
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			mensaje('error', data, '#mensaje')
		}
	});
});

</script>