@extends('plantilla.principal')

@section('css')
	@include('contabilidad.configuracion.css.css')
@endsection

@section('encabezadoContenido')
	<h1>Configuración</h1>
@endsection

@section('contenido')
	<div class="row">
		
		<div class="col-sm-9 nav-tabs-custom">
			<ul class="nav nav-tabs" role="tablist">
				 <li role="presentation" class="active">
				 	<a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos</a>
				 </li>

				 <li role="presentation">
				 	<a href="#boxPorcentajeIVA" aria-controls="boxPorcentajeIVA" role="tab" data-toggle="tab">Retenciones de IVA</a>
				 </li>

				 <li role="presentation">
				 	<a href="#boxPorcentajeRenta" aria-controls="boxPorcentajeRenta" role="tab" data-toggle="tab">Retenciones de Renta</a>
				 </li>

				 <li role="presentation">
				 	<a href="#boxCuentasXPagar" aria-controls="boxCuentasXPagar" role="tab" data-toggle="tab">Cuentas por Pagar</a>
				 </li>

				 <li role="presentation">
				 	<a href="#boxPagos" aria-controls="boxPagos" role="tab" data-toggle="tab">Pagos</a>
				 </li>
			</ul>	

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="datos">
					@include('contabilidad.configuracion.include.boxImpuestos')	
				</div>

				<div id="boxPorcentajeIVA" role="tabpanel" class="tab-pane">
					@include('contabilidad.configuracion.include.boxPorcentajeIVA')	
				</div>

				<div id="boxPorcentajeRenta" role="tabpanel" class="tab-pane">
					@include('contabilidad.configuracion.include.boxPorcentajeRenta')
				</div>

				<div id="boxCuentasXPagar" role="tabpanel" class="tab-pane">
					@include('contabilidad.configuracion.include.boxCuentasXPagar')
				</div>

				<div id="boxPagos" role="tabpanel" class="tab-pane">
					@include('contabilidad.configuracion.include.boxPagos')
				</div>
			</div>
		</div>

	</div>

	@include('contabilidad.configuracion.include.modalNuevaIVA')
	@include('contabilidad.configuracion.include.modalEditarIVA')
	@include('contabilidad.configuracion.include.modalEliminarIVA')
	@include('contabilidad.configuracion.include.modalNuevaRenta')
	@include('contabilidad.configuracion.include.modalEditarRenta')
	@include('contabilidad.configuracion.include.modalEliminarRenta')
	@include('contabilidad.configuracion.include.modalNuevaCuentaXPagar')
	@include('contabilidad.configuracion.include.modalEditarCtaXPagar')
	@include('contabilidad.configuracion.include.modalNuevoPago')
	@include('contabilidad.configuracion.include.modalEditarPago')
@endsection

@push('js')
	@include('contabilidad.configuracion.js.js')
	@include('contabilidad.configuracion.js.jsRetencionIVA')
	@include('contabilidad.configuracion.js.jsRetencionRenta')
	@include('contabilidad.configuracion.js.jsCuentasXPagar')
	@include('contabilidad.configuracion.js.jsPagos')
@endpush