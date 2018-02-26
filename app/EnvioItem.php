<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvioItem extends Model
{
    //-------------------------------RELACIONES---------------------------------
    public function producto()
    {
    	return $this->belongsTo('App\product', 'product_id');
    }

    public function stock()
    {
    	return $this->belongsTo('App\Stock', 'stock_id');
    }
}
