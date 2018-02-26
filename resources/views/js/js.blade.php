<script type="text/javascript">

var fntEstado;
var fntData;

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

function guardarFormulario(formId, modal, btnGuardar, url, datos) {

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: url,
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#'+formId+' input').prop('disabled', true);
			$('#'+modal+' .cerrar').removeAttr('data-dismiss');
			$('#'+btnGuardar+'').prop('disabled', true);
			$('#'+btnGuardar+'').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			$('#'+formId+' input').prop('disabled', false);
			$('#'+modal+' .cerrar').attr('data-dismiss','modal');
			$('#'+btnGuardar+'').prop('disabled', false);
			$('#'+btnGuardar+'').html('Guardar');
			$('#'+modal+'').modal('hide');

			fntEstado = true;
			fntData = data;
		},
		error: function (data) {
			$('#'+formId+' input').prop('disabled', false);
			$('#'+modal+' .cerrar').attr('data-dismiss','modal');
			$('#'+btnGuardar+'').prop('disabled', false);
			$('#'+btnGuardar+'').html('Guardar');

			fntEstado = false;
			fntData = data;
		}
	});
}

function tablaIndex(url, pagina, filtro) {
	
	$.ajax({
  		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: url,
		type: 'GET',
		data: {'page':pagina, 'filtro':filtro},
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
		},
		success: function (data) {
			$('.overlay').detach();
			
			fntEstado = true;
			fntData = data;
		},
		error: function (data) {
			$('.overlay').detach();

			fntEstado = false;
			fntData = data;
		}
  	});
}

</script>