<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model{

    protected $fillable = ['product_id', 'color'];

    //------------------------------------RELACIONES-----------------------------------
    public function producto(){
        return $this->belongsTo('App\Product', 'product_id');
    }
    //----------------------------------------------------------------------------------
    //------------------------------------METODOS---------------------------------------
    /**
     * Devuelve el valor de numero de orden que se debe ingresar.
     *
     * @return int
     */
    public function numeroDeOrden()
    {
    	$imagenes = $this->producto->imagenes;

    	return ($imagenes->count() == 0)?1:array_get($imagenes->last(), 'n_orden')+1;
    }
}
