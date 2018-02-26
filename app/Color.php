<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class Color extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['color'];

    public function scopeBuscar($query, $buscar)
    {
    	return $query->where([
    					['color', 'like', '%'.$buscar.'%'],
    					['empresa_id', '=', Empresa::get()->id]]);
    }
}
