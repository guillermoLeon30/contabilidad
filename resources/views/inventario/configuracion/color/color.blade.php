@extends('plantilla.principal')

@section('css')
	@include('inventario.configuracion.color.estilos')
@endsection

@section('encabezadoContenido')
	<h1>Colores</h1>
@endsection

@section('contenido')
	@include('inventario.configuracion.color.include.mostrar')
	@include('inventario.configuracion.color.include.eliminar')
	<div class="row">

	<div id="mensaje"></div>

	<div class="col-lg-5 col-md-5 col-sm-8 col-xs-12">
		@include('inventario.configuracion.color.include.ingresar')
	
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="box-tools">
					<div class="input-group input-group-sm" style="150px">
						<input type="text" id="buscar" name="buscar" class="form-control pull-right" placeholder="Buscar">
					</div>
				</div>
				<br>
			</div>				

			<div id="colores">
				@include('inventario.configuracion.color.include.colores')
			</div>
		</div>

		</div>
	</div>
@endsection

@push('js')
	@include('inventario.configuracion.color.funciones')
@endpush