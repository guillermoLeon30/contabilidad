<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductStock;
use App\Product;
use App\Stock;
use App\EnvioItem;

class ItemsCompra extends Model
{

	//-------------------------------Metodos-----------------------------------------    
	public function producto()
	{
		$product_stock_id = $this->product_stock;
		$product_id = ProductStock::findOrFail($product_stock_id)->product_id;
		
		return Product::findOrFail($product_id);
	}

	public function stock()
	{
		$product_stock_id = $this->product_stock;
		$stock_id = ProductStock::findOrFail($product_stock_id)->stock_id;

		return Stock::findOrFail($stock_id);
	}

	public function color()
	{
		$product_stock_id = $this->product_stock;

		return ProductStock::findOrFail($product_stock_id)->color;
	}

	/**
     * Devuelve la cantidad de articulos disponibles que se puede enviar
     *
     * @return decimal(10,2)
     */
	public function cantidadDisponible()
	{
		$itemsEnviados = EnvioItem::where('items_compras_id', $this->id)->get();

		if ($itemsEnviados->count() > 0) {
			return $this->cantidad - $itemsEnviados->sum('contidad');
		}else{
			return $this->cantidad;
		}
	}
}
