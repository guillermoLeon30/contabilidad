<?php

namespace App\Validacion;

use Illuminate\Validation\Validator;
use App\Facades\Empresa;
use App\Color;
use App\Product;
use App\ProductMark;
use App\ProductUnitMeasure;
use App\ProductCategory;
use App\Store;
use App\ClsCtaXPagar;
use App\ClsPago;
use Carbon\Carbon;

class Validacion extends Validator
{
	public function validateColorUnico($attribute, $value, $parameters)
	{
		$colores = Color::where([
				['color', '=', $value],
				['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($colores > 0)?false:true;
	}

	public function validateUnidadUnico($attribute, $value, $parameters)
	{
		$unidades = ProductUnitMeasure::where([
				['unidad', '=', $value],
				['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($unidades > 0)?false:true;
	}

	public function validateSimboloUnico($attribute, $value, $parameters)
	{
		$unidades = ProductUnitMeasure::where([
				['simbolo', '=', $value],
				['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($unidades > 0)?false:true;
	}

	public function validateMarcaUnico($attribute, $value, $parameters)
	{
		$marcas = ProductMark::where([
				['marca', '=', $value],
				['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($marcas > 0)?false:true;
	}

	public function validateCategoriaUnica($attribute, $value, $parameters)
	{
		$categorias = ProductCategory::where([
				['categoria', '=', $value],
				['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($categorias > 0)?false:true;
	}

	public function validateEsActualizable($attribute, $value, $parameters)
	{
		$tipo = Store::findOrFail($parameters[0])->tipo;

		return ($tipo == 'Matriz' && $value == 'Sucursal')?false:true;
	}

	public function validateEsActualizableColorProducto($attribute, $value, $parameters)
	{
		$idProducto = $parameters[0];
		$producto = Product::findOrFail($idProducto);
		$colores = $producto->colores();

		return !in_array($value, $colores);
	}

	public function validateDimensionProductoUnico($attribute, $value, $parameters)
	{
		$idProducto = $parameters[0];
		$producto = Product::findOrFail($idProducto);
		$dimensiones = $producto->dimensiones->pluck('dimension')->all();
		
		return !in_array($value, $dimensiones);
	}

	public function validateCtaXPagarUnica($attribute, $value, $parameters)
	{
		$cuentas = ClsCtaXPagar::where([
			['cuenta', '=', $value],
			['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($cuentas > 0)?false:true;
	}

	public function validateClsPagoUnico($attribute, $value, $parameters)
	{
		$cuentas = ClsPago::where([
			['cuenta', '=', $value],
			['empresa_id', '=', Empresa::get()->id]
		])->count();

		return ($cuentas > 0)?false:true;
	}

	public function validateRequeridoSiValorYcampoCero($attribute, $value, $parameters)
	{
		$valorAcomparar = $parameters[0];

		return ($value == 0 && $valorAcomparar==0)?false:true;
	}

	public function validateIvaRequerido($attribute, $value, $parameters)
	{
		$monto_facturado = $parameters[0];

		return ($monto_facturado > 0 && $value == 0)?false:true;
	}

	public function validateRequeridoSiHayRetencion($attribute, $value, $parameters)
	{
		$campo0 = $parameters[0];
		$campo1 = $parameters[1];

		return (strcasecmp($campo0, $campo1) == 0 && (is_null($value) || $value == 0))?false:true;
	}

	public function validateFecha($attribute, $value, $parameters)
	{
		$formato = (isset($parameters[0]))?$parameters[0]:'d/m/Y';

		$d = Carbon::createFromFormat('d/m/Y', $value);

		return $d && $d->format($formato) == $value;
	}

	public function validateEsArregloNumerico($attribute, $value, $parameters)
	{
		foreach ($value as $numero) {
			if (!is_numeric($numero)) {
				return false;
			}
		}

		return true;
	}

	public function validateEsArregloFechas($attribute, $value, $parameters)
	{
		foreach ($value as $fecha) {
			$d = Carbon::createFromFormat('d/m/Y', $fecha);
			if (!$d && $d->format($formato) != $value) {
				return false;
			}
		}
		
		return true;
	}

	public function validateEsArregloMayorCero($attribute, $value, $parameters)
	{
		foreach ($value as $numero) {
			if (!is_numeric($numero) || $numero <= 0) {
				return false;
			}
		}

		return true;
	}

	public function validateEsValidoCantidadEnvio($attribute, $value, $parameters)
	{
		$cantidadDisponible = $value['cantidadDisponible'];
		$cantidad = $value['cantidad'];
		$tam = count($cantidadDisponible);

		for ($i=0; $i < $tam; $i++) { 
			if ($cantidadDisponible[$i] < $cantidad[$i]) {
				return false;
			}
		}

		return true;
	}
}