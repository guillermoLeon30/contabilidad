<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Store;

class Envio extends Model
{
    protected $fillable = ['store_id', 'compra_id'];

    //-------------------------------RELACIONES----------------------------------------
    public function items()
    {
        return $this->hasMany('App\EnvioItem', 'envio_id');
    }


    //---------------------------ALCANCE DE DATOS--------------------------------------
    public function scopeBuscar($query, $fechaInicial, $fechaFinal, $storeId)
    {
    	if (empty($fechaInicial) || empty($fechaFinal)) {
            return $query->where('store_id', $storeId);
        }elseif (empty($storeId)){
            $fechaInicial = Carbon::createFromFormat('d/m/Y', $fechaInicial)->toDateString();
            $fechaFinal = Carbon::createFromFormat('d/m/Y', $fechaFinal)->toDateString();

            return $query->whereDate('fecha', '>=', $fechaInicial)
                         ->whereDate('fecha', '<=', $fechaFinal);
        }else{
        	$fechaInicial = Carbon::createFromFormat('d/m/Y', $fechaInicial)->toDateString();
            $fechaFinal = Carbon::createFromFormat('d/m/Y', $fechaFinal)->toDateString();

            return $query->where('store_id', $storeId)
                         ->where(function ($query) use($fechaInicial, $fechaFinal){
                             $query->whereDate('fecha', '>=', $fechaInicial)
                                   ->whereDate('fecha', '<=', $fechaFinal);
                         });    
        }
    }

    //-------------------------------METODOS---------------------------------------------
    public function fecha()
    {
    	return Carbon::createFromFormat('Y-m-d', $this->fecha)->format('d/m/Y');
    }

    public function store()
    {
    	return Store::where('id', $this->store_id)->get()->first();
    }
}
