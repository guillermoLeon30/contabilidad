<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class ProductCategory extends Model{

        protected $fillable = ['categoria'];
    
    //------------------------------------RELACIONES-----------------------------------
    public function productos()
    {
        return $this->belongsToMany('App\Product', 'products_product_categories')->withTimestamps();
    }
    //----------------------------------------------------------------------------------

    //---------------------------------ALCANCES DE CONSULTA----------------------------------    
    public function scopeBuscar($query, $buscar)
    {
    	return $query->where([
    		['categoria', 'like', '%'.$buscar.'%'],
    		['empresa_id', '=', Empresa::get()->id]
    	]);
    }
    //-----------------------------------------------------------------------------------------

    //------------------------------------METODOS-----------------------------------------
    
    //------------------------------------------------------------------------------------
}
