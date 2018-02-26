<script type="text/javascript">
	
function ver(compraId) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/compras') }}/' + compraId,
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
		},
		success: function (data) {
			$('#tablaVer').html(data);
			$('.overlay').detach();
			$('#modalVer').modal('show');
		},
		error: function (data) {
			$('.overlay').detach();
			mensaje2('error', 'Ocurrio un error con la conexión.', '#mensaje')
		}
	});
}

</script>