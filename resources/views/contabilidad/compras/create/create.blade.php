@extends('plantilla.principal')

@section('css')
	@include('contabilidad.compras.create.css.css')
@endsection

@section('encabezadoContenido')
	<h1>Nueva Compra</h1>
	<h4>
		<ol id="bread" class="breadcrumb">
		  <li><a href="{{ url('contabilidad/compras') }}">Compras</a></li>
		  <li class="active">Nueva</li>
		</ol>
	</h4>
@endsection

@section('contenido')
	<div class="row">
		<div class="col-sm-9" id="mensaje"></div>

			<form id="formCrearCompra">
				<div class="col-sm-9 nav-tabs-custom">
					<ul class="nav nav-tabs pull-right" role="tablist">
						<li class="pull-left header">
							<button type="submit" id="btnGuardar" class="btn btn-success">
								<span class="fa fa-save" aria-hidden="true"></span>
							</button>
						</li>
						<li role="presentation" class="active">
							<a href="#tabDatos" aria-controls="tabDatos" role="tab" data-toggle="tab">Datos</a>
						</li>
						<li role="presentation" >
							<a href="#tabItems" aria-controls="tabItems" role="tab" data-toggle="tab">Items</a>
						</li>
						<li role="presentation" id="liRetencion">
							
						</li>
						<li role="presentation">
							<a href="#tabPagos" aria-controls="tabPagos" role="tab" data-toggle="tab">Pagos</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active compra" role="tabpanel" id="tabDatos">
							@include('contabilidad.compras.create.include.tabDatos')
						</div>

						<div class="tab-pane" role="tabpanel" id="tabItems">
							@include('contabilidad.compras.create.include.tabItems')	
						</div>

						<div class="tab-pane compra" role="tabpanel" id="tabRetenciones">
							@include('contabilidad.compras.create.include.tabRetenciones')	
						</div>

						<div class="tab-pane cuentaXPagar" role="tabpanel" id="tabPagos">
							@include('contabilidad.compras.create.include.tabPagos')	
						</div>
					</div>
				</div>
			</form>
	</div>
	
	@include('contabilidad.compras.create.include.modalIngresarItems')
	@include('contabilidad.compras.create.include.modalIngresarPagos')
	
@endsection

@push('js')
	@include('contabilidad.compras.create.js.js')
	@include('contabilidad.compras.create.js.jsTabDatos')
	@include('contabilidad.compras.create.js.jsTabItems')
	@include('contabilidad.compras.create.js.jsTabRetenciones')
	@include('contabilidad.compras.create.js.jsTabPagos')
	@include('contabilidad.compras.create.js.jsPrincipal')
@endpush