<script type="text/javascript">

$('.fecha').datepicker({
    autoclose: true,
    language: 'es',
    todayHighlight: true
});

$('#selProveedores').select2({
	ajax: {
		id: function (e) {
			return proveedor.id;
		},
		url: '{{ url('contabilidad/proveedores') }}',
		type: 'GET',
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
				filtro: params.term,
				todos: 'todos',
				page: params.page
			};
		},
		processResults: function (data, params) {
			params.page = params.page || 1;

			return {
				results: data.proveedores,
				pagination: {
		          more: (params.page * 20) < data.total_count
		        }
			};
		}
	},
	cache: true,
	templateResult: formatProveedor,
	templateSelection: formatRepoProveedor,
	dropdownParent: $('#modalBuscar'),
	placeholder: 'Ninguno',
	allowClear: true
});

function formatProveedor (proveedor) {
  if (!proveedor.id) { return proveedor.text; }
  var $proveedor = $(
    	'<span>'+
			'<table>'+
				'<tbody>'+
					'<tr>'+
						'<td>'+
							'<strong>Proveedor: </strong> '+ proveedor.nombre_empresa +
						'</td>'+
					'</tr>'+

					'<tr>'+
						'<td>'+
							'<strong>Tipo: </strong> '+ tipo(proveedor.tipo) +
						'</td>'+
					'</tr>'+
				'</thead>'+
			'</tbody>'+
		'</span>'
  );
  return $proveedor;
}

function formatRepoProveedor(proveedor) {
	if (!proveedor.id) { return proveedor.text; }
	var $proveedor = $(
	    	'<span>'+
				proveedor.nombre_empresa+
				' (' + tipo(proveedor.tipo) + ')'+
			'</span>'
	);

	return $proveedor;
}

var tipoProveedor;

function tipo(tipo) {
	if (tipo.localeCompare('Obligado') == 0){
		tipoProveedor = 'Obligado';
		return 'Obligado a llevar contabilidad.';
	}else if (tipo.localeCompare('NoObligado') == 0){
		tipoProveedor = 'NoObligado';
		return 'No Obligado a llevar contabilidad.';
	}else if (tipo.localeCompare('Especial') == 0){
		tipoProveedor = 'Especial';
		return 'Contribuyente Especial';
	}
}

$('#formBuscar').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/compras') }}',
		type: 'GET',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
			$('#modalBuscar').modal('hide');
		},
		success: function (data) {
			$('#tabla').html(data);
			$('.overlay').detach();

		},
		error: function (data) {
			$('.overlay').detach();
		}
	});
});

</script>