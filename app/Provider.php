<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class Provider extends Model
{
    protected $fillable = ['nombre_empresa', 'telefono_convencional', 'correo', 'tipo', 'descripcion', 'direccion', 'ciudad', 'provincia', 'pais'];
    
    //------------------------------------RELACIONES-----------------------------------
    public function productos()
    {
        return $this->hasMany('App\ProviderProduct');
    }

   	//---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('empresa_id', '=', Empresa::get()->id)
                     ->where(function ($query) use($buscar){
                        $query->where('nombre_empresa', 'like', '%'.$buscar.'%')
                              ->orWhere('direccion', 'like', '%'.$buscar.'%')
                              ->orWhere('provincia', 'like', '%'.$buscar.'%')
                              ->orWhere('ciudad', 'like', '%'.$buscar.'%')
                              ->orWhere('pais', 'like', '%'.$buscar.'%');
                     });
    }
    //----------------------------------------------------------------------------------
    //------------------------------------METODOS-----------------------------------------
}
