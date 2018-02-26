@extends('plantilla.principal')

@section('encabezadoContenido')
	<h1>Sucursales</h1>
@endsection

@section('contenido')
	@include('configuracion.sucursal.include.ingresar')
	@include('configuracion.sucursal.include.mostrar')
	@include('configuracion.sucursal.include.eliminar')

	<div class="row">

		<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9" id="mensaje"></div>

		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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

				<div id="sucursales">
					@include('configuracion.sucursal.include.sucursales')
				</div>
			</div>
		</div>

	</div>
@endsection

@push('js')
	@include('configuracion.sucursal.funciones')
@endpush