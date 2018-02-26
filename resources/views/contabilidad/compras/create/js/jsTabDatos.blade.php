<script type="text/javascript">

$(document).ready(function () {
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
		templateSelection: formatRepoProveedor
	});	
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

$('#selProveedores').on('select2:select', function (evt) {
	var tipoEmpresa = '{{ $empresa->tipo }}';

  	if (tipoEmpresa.localeCompare('Obligado') == 0 && tipoProveedor.localeCompare('Especial') == 0) {
  		$('#retiene').val('no');
  		$('#aRetecion').remove();
  	}else if (tipoEmpresa.localeCompare('Obligado') == 0) {
  		$('#retiene').val('si');
  		$('#liRetencion').html('<a id="aRetecion" href="#tabRetenciones" aria-controls="tabRetenciones" role="tab" data-toggle="tab">Retenciones</a>');
  	}
  	
  	if (tipoEmpresa.localeCompare('NoObligado') == 0) {
  		$('#retiene').val('no');
  		$('#aRetecion').remove();
  	}
});

</script>