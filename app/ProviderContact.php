<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderContact extends Model
{
	protected $fillable = ['provider_id', 'nombre', 'telefono', 'celular', 'correo', 'cargo'];

    //---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar, $idProveedor)
    {
        return $query->where([['provider_id', '=', $idProveedor],
        					  ['nombre', 'like', '%'.$buscar.'%']
        					 ]);
    }
    //----------------------------------------------------------------------------------
}
