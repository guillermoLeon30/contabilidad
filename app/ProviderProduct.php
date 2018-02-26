<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderProduct extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'providers_products';

    protected $fillable = ['provider_id', 'marca'];

    //---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar, $idProvider)
    {
        return $query->where([['provider_id', '=', $idProvider],
        					  ['marca', 'like', '%'.$buscar.'%']
        					]);
    }
    //----------------------------------------------------------------------------------
}
