@extends('plantilla.principal')

@section('css')
	@include('contabilidad.compras.css.css')
@endsection

@section('encabezadoContenido')
	<h1>Compras</h1>
@endsection

@section('contenido')
	<div class="row">
		<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9" id="mensaje"></div>

		<div class="col-sm-11 col-xs-12">

			<div class="box box-primary">
				<div class="box-header with-border">
					<a href="{{ url('contabilidad/compras/create') }}" class="btn btn-success">
						<i class="glyphicon glyphicon-plus"></i>
						Nuevo
					</a>
					
		            <button class="btn btn-info pull-right" data-toggle="modal" data-target="#modalBuscar">
						<i class="glyphicon glyphicon-search"></i>
						Buscar
					</button>
			        
				</div>

				<div id="tabla">
					
				</div>
				

			</div>

		</div>
	</div>

	@include('contabilidad.compras.include.modalBuscar')
	@include('contabilidad.compras.include.modalVer')
	@include('contabilidad.compras.include.modalEliminar')

@endsection

@push('js')
	@include('contabilidad.compras.js.js')
	@include('contabilidad.compras.js.jsModalBuscar')
	@include('contabilidad.compras.js.jsModalVer')
	@include('contabilidad.compras.js.jsModalEliminar')
@endpush