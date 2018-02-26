<script type="text/javascript">
	
$('#selectRetencionIva').change(function () {
	calculoCompra();
	calculoRetencionIva();
	calculoRetencionRenta();
	calculoCompra();
});

function calculoRetencionIva() {
	var porcentaje = $('#selectRetencionIva').val();
	var iva = $('#montoConIva').val() * {{ $empresa->iva }} / 100;
	var total = iva * porcentaje / 100;

	$('#porcentajeIva').val(porcentaje);
	$('#retencionIVA').val(total.toFixed(2));
}

$('#selectRetencionRenta').change(function () {
	calculoCompra();
	calculoRetencionIva();
	calculoRetencionRenta();
	calculoCompra();	
});

function calculoRetencionRenta() {
	var porcentaje = $('#selectRetencionRenta').val();
	var monto = $('#montoConIva').val();
	var total = monto * porcentaje / 100;

	$('#porcentajeRenta').val(porcentaje);
	$('#retencionRenta').val(total.toFixed(2));
}

</script>