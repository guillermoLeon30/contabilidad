<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class ClsPago extends Model
{
    protected $fillable = ['empresa_id', 'cuenta'];

    //-------------------------ALCANCE DE DATOS--------------------------------
	public function scopeClsPagos($query)
	{
		return $query->where('empresa_id', '=', Empresa::get()->id);
	}
}
