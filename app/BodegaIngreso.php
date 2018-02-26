<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodegaIngreso extends Model
{
    
    //-------------------------------------------METODOS------------------------------------------
    public function idProductStock($idProducto, $idStock, $color)
    {
    	return ProductStock::where([
    			['product_id', $idProducto],
    			['stock_id', $idStock],
    			['color', $color]
    		])->get()->first()->id;
    }
}
