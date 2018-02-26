<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;


class ProductMark extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['marca'];

    public function scopeBuscar($query, $buscar)
    {
    	return $query->where([
    		['marca', 'like', '%'.$buscar.'%'],
    		['empresa_id', '=', Empresa::get()->id]
    	]);
    }
}
