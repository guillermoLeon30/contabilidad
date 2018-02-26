<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class ProductUnitMeasure extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unidad','simbolo'];

    public function scopeBuscar($query, $buscar)
    {
    	return $query->where('empresa_id', '=', Empresa::get()->id)
    				 ->where(function ($query) use($buscar){
    				 	$query->where('unidad', 'like', '%'.$buscar.'%')
    				 		  ->orWhere('simbolo', 'like', '%'.$buscar.'%');
    				 });
    }
}
