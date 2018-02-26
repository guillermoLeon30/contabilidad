<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;

class Empresa extends Model
{
    protected $fillable = ['nombre', 'iva', 'ruc', 'tipo'];

    public function users(){
        return $this->belongsToMany('App\User', 'user_empresa_store')->withTimestamps();
    }

    public function stores(){
        return $this->belongsToMany('App\Store', 'user_empresa_store')->withTimestamps();
    }

    public function retencionesIva()
    {
    	return $this->hasMany('App\PorcentajeRetencionIva');
    }

    public function retencionesRenta()
    {
        return $this->hasMany('App\PorcentajeRetencionRenta');
    }

    public function tipoDePagos()
    {
        return $this->hasMany('App\ClsPago');
    }

    //----------------------------------METODO-------------------------------

    public function sucursales()
    {
        return Store::where('empresa_id',$this->id)->get();
    }
}
