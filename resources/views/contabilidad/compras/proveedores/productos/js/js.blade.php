<script type="text/javascript">

var page=1;

//----------------------GENERAR TABLA-------------------------
	$(document).on('click', '.pagination a', function (e) {
		e.preventDefault();
		page = $(this).attr('href').split('page=')[1];
		var filtro = $('#buscar').val();
		
		generarTabla(page, filtro);
	});

	function generarTabla(page, filtro) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{ url('contabilidad/proveedores/producto') }}/' + {{ $idProveedor }},
			type: 'GET',
			data: {'page':page, 'filtro':filtro},
			dataType: 'json',
			beforeSend: function () {
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#tabla').html(data);
				$('.overlay').detach();
			},
			error: function () {
				$('.overlay').detach();
				mensaje2('error', 'Ocurrio un error con la conexión.', '#mensaje');
			}
		});
	}
//----------------------------------------------------------
//---------------------BUSCAR-------------------------------
	$('#buscar').on('keyup', function () {
		var filtro = $('#buscar').val();

		generarTabla(1, filtro);
	});
//----------------------------------------------------------
//------------------------ELIMINAR--------------------------
function eliminar(id) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('contabilidad/proveedores/producto') }}/' + id,
		type: 'DELETE',
		dataType: 'json',
		beforeSend: function () {
            $('.box').append('<div class="overlay">'+
            					'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
        },
        success: function (data) {
        	var filtro = $('#buscar').val();

        	$('.overlay').detach();
        	generarTabla(page, filtro);
        	mensaje('ok', data, '#mensaje');
        },
        error: function () {
        	mensaje2('error', 'Ocurrio un error con la conexión.', '#mensaje');
        }
	});
}
//----------------------------------------------------------------
//---------------------MENSAJE------------------------------
	function mensaje(tipo, data, lugar) {
		var tipoAlerta, icono, titulo, html, mensajes='';

		if (tipo == 'ok') {
			tipo = 'alert alert-success alert-dismissible';
			icono = 'icon fa fa-check';
			titulo = 'Exito!';
			mensajes = data.mensaje;

		}else if (tipo == 'error') {
			tipo = 'alert alert-danger alert-dismissible';
			icono = 'icon fa fa-ban';
			titulo = 'Alerta!';
			var arrayMensajes = data.responseJSON;
			mensajes = '<ul>';
			$.each(arrayMensajes, function (i, reg) {
				mensajes +=	'<li>'+reg+'</li>';
			});
			mensajes += '</ul>';
		}

		var html = 	'<div class="'+tipo+'">'+
		            	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
		            	'<h4><i class="'+icono+'"></i> '+titulo+'</h4>'+
		            	mensajes+
		            '</div>';
		        	
		$(lugar).html(html); 
	}

	function mensaje2(tipo, mensaje, lugar) {
		var tipoAlerta, icono, titulo, html, mensajes='';

		if (tipo == 'ok') {
			tipo = 'alert alert-success alert-dismissible';
			icono = 'icon fa fa-check';
			titulo = 'Exito!';
		}else if (tipo == 'error') {
			tipo = 'alert alert-danger alert-dismissible';
			icono = 'icon fa fa-ban';
			titulo = 'Alerta!';
		}

		var html = 	'<div class="'+tipo+'">'+
		            	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
		            	'<h4><i class="'+icono+'"></i> '+titulo+'</h4>'+
		            	mensaje+
		            '</div>';
		        	
		$(lugar).html(html); 
	}	

</script>