@extends('plantilla.principal')

@section('css')
	@include('inventario.configuracion.unidad.estilos')
@endsection

@section('encabezadoContenido')
	<h1>Unidades</h1>
@endsection

@section('contenido')
	@include('inventario.configuracion.unidad.include.mostrar')
	@include('inventario.configuracion.unidad.include.eliminar')
	@include('inventario.configuracion.unidad.include.ingresar')
	
	<div class="row">

	<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9" id="mensaje"></div>


	<div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
		<button id="registrarIngreso" type="button" class="btn btn-success" data-toggle="modal" data-target="#ingresarModal" style="margin-bottom: 6px;">Ingresar</button>

		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-tools">
					<div class="input-group input-group-sm" style="150px">
						<input type="text" id="buscar" name="buscar" class="form-control pull-right" placeholder="Buscar">
					</div>
				</div>
				<br>
			</div>				

			<div id="marcas">
				@include('inventario.configuracion.unidad.include.unidades')
			</div>
		</div>
	</div>

	</div>
@endsection

@push('js')
	@include('inventario.configuracion.unidad.funciones')
@endpush