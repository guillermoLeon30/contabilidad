<script>
//----------------------GENERAR TABLA-------------------------
	$(document).on('click', '.pagination a', function (e) {
		e.preventDefault();
		var page = $(this).attr('href').split('page=')[1];
		var filtro = $('#buscar').val();
		
		generarTabla(page, filtro);
	});

	function generarTabla(page, filtro) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{ url('inventario/configuracion/Color') }}',
			type: 'GET',
			data: {'page':page, 'filtro':filtro},
			dataType: 'json',
			beforeSend: function () {
				$('#color').prop('disabled', true);
		 		$('#registrarIngreso').prop('disabled', true);
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
				$('#colores').html(data);
				$('.overlay').detach();
			}
		});
	}
//------------------------------------------------------------
//------------------------GUARDAR----------------------------- 
	$('#registrar').submit(function (e) {
		e.preventDefault();
		var datos = $(this).serialize();
		var page = $('.pagination .active span').html();
		
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{ url('inventario/configuracion/Color') }}',
		 	type: 'POST',
		 	data: datos,
		 	dataType: 'json',
		 	beforeSend: function () {
				$('#color').prop('disabled', true);
				$('#registrarIngreso').html('<i class="fa fa-refresh fa-spin"></i>');
		 		$('#registrarIngreso').prop('disabled', true);
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
		 	success: function (data) {
		 		$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('#registrarIngreso').html('Ingresar');
		 		generarTabla(page);
		 		mensaje('ok', data);
		 		$('.overlay').detach();
		 	},
		 	error: function (data) {
		 		$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('#registrarIngreso').html('Ingresar');
		 		mensaje('error', data);
		 		$('.overlay').detach();
		 	}
		});
	});
//----------------------------------------------------------
//----------------MOSTRAR MODAL ACTUALIZAR------------------
	function mostrar(id) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		 	url: '{{url('inventario/configuracion/Color')}}/'+id+'/edit',
		 	type: 'GET',
		 	dataType: 'json',
		 	beforeSend: function () {
				$('#color').prop('disabled', true);
		 		$('#registrarIngreso').prop('disabled', true);
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
		 	success: function (data) {
		 		$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('#mostarColor').modal('show');
		 		$('.overlay').detach();
		 		$('#actualizarColor').val(data.color);
		 		$('#actualizarId').val(data.id);
		 	}
		});
	}
//----------------------------------------------------------
//---------------MOSTRAR MODAL ELIMINAR---------------------
	function eliminar(id) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		 	url: '{{url('inventario/configuracion/Color')}}/'+id+'/edit',
		 	type: 'GET',
		 	dataType: 'json',
		 	beforeSend: function () {
				$('#color').prop('disabled', true);
		 		$('#registrarIngreso').prop('disabled', true);
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
		 	success: function (data) {
		 		$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('#eliminarColor').modal('show');
		 		$('.overlay').detach();
		 		$('#eliminarId').val(data.id);
		 	}
		});	
	}
//----------------------------------------------------------
//-----------------ACTUALIZAR DATOS-------------------------
	$('#actualizar').submit(function (e) {
		e.preventDefault();
		var datos = $(this).serialize();
		var page = $('.pagination .active span').html();

		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{url('inventario/configuracion/Color')}}/'+$('#actualizarId').val(),
			type: 'PUT',
			data: datos,
			dataType: 'json',
			beforeSend: function () {
				$('#mostarColor').modal('hide');
				$('#color').prop('disabled', true);
		 		$('#registrarIngreso').prop('disabled', true);
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('.overlay').detach();
				mensaje('ok',data);
				generarTabla(page);
			},
			error: function (data) {
				$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('.overlay').detach();
				mensaje('error', data);
			}
		});
	});
//---------------------------------------------------------
//-------------------ELIMINAR DATOS------------------------
	$('#eliminar').submit(function (e) {
		e.preventDefault();
		var page = $('.pagination .active span').html();

		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{url('inventario/configuracion/Color')}}/'+$('#eliminarId').val(),
			type: 'DELETE',
			dataType: 'json',
			beforeSend: function () {
				$('#eliminarColor').modal('hide');
				$('#color').prop('disabled', true);
		 		$('#registrarIngreso').prop('disabled', true);
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('.overlay').detach();
				mensaje('ok', data);
				generarTabla(page);
			},
			error: function (data) {
				$('#color').prop('disabled', false);
		 		$('#registrarIngreso').prop('disabled', false);
		 		$('.overlay').detach();
				mensaje('error', data);
			}
		});
	})
//----------------------------------------------------------
//---------------------BUSCAR-------------------------------
	$('#buscar').on('keyup', function () {
		var filtro = $('#buscar').val();

		generarTabla(1, filtro);
	});
//----------------------------------------------------------
//---------------------MENSAJE------------------------------
	function mensaje(tipo, data) {
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

		var html = 	'<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9">'+
		            	'<div class="'+tipo+'">'+
		               		'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
		               		'<h4><i class="'+icono+'"></i> '+titulo+'</h4>'+
		               		mensajes+
		            	'</div>'+
		          	'</div>';
		        	
		$('#mensaje').html(html); 
	}
</script>