@extends('plantilla.principal')

@section('css')
	
@endsection

@section('encabezadoContenido')
	<h1>Proveedores</h1>
@endsection

@section('contenido')
	<div class="row">
		<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9" id="mensaje"></div>

		<div class="col-sm-11 col-xs-12">

			<div class="box box-primary">
				<div class="box-header with-border">
					<button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo">
						<i class="glyphicon glyphicon-plus"></i>
						Nuevo
					</button>

					<div class="box-tools">
			            <div class="input-group input-group-sm" style="width: 150px;">
			                <input type="text" id="buscar" class="form-control pull-right" placeholder="Buscar">
			                <span class="input-group-addon"><i class="fa fa-search"></i></span>
			            </div>
			        </div>	
				</div>

				<div id="tabla">
					@include('contabilidad.compras.proveedores.include.tabla')	
				</div>
				

			</div>

		</div>
	</div>

	@include('contabilidad.compras.proveedores.include.modalNuevo')
	@include('contabilidad.compras.proveedores.include.modalEditar')

@endsection

@push('js')
	@include('contabilidad.compras.proveedores.js.js')
	@include('contabilidad.compras.proveedores.js.jsModalNuevo')
	@include('contabilidad.compras.proveedores.js.jsModalEditar')
@endpush