<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Stock extends Model
{
	protected $fillable = ['product_id', 'dimension', 'costo', 'ganancia_por_menor', 'pocentaje_ganancia_por_menor', 'descuento_por_menor', 'porcentaje_descuento_por_menor', 'precio_por_menor_inc_iva', 'ganancia_por_mayor', 'pocentaje_ganancia_por_mayor', 'descuento_por_mayor', 'porcentaje_descuento_por_mayor', 'precio_por_mayor_inc_iva'];
    
    //------------------------------------RELACIONES-----------------------------------
	public function producto()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	public function productos()
	{
		return $this->belongsToMany('App\Product', 'product_stock')->withTimestamps();
	}
	//----------------------------------------------------------------------------------
	//------------------------------------METODOS---------------------------------------
    /**
     * Devuelve el valor de numero de orden que se debe ingresar.
     *
     * @idProducto  int
     * @return int
     */
	public function numeroDeOrden($idProducto)
	{
		$producto = Product::findOrFail($idProducto);

		return array_get($producto->dimensiones->last(), 'n_orden')+1;
	}

	//----------------------------------------------------------------------------------
}
