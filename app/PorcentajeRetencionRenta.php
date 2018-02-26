<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class PorcentajeRetencionRenta extends Model
{
    protected $fillable = ['empresa_id', 'detalle', 'porcertaje'];
    
    //-------------------------ALCANCE DE DATOS--------------------------------
	public function scopeRetenciones($query)
	{
		return $query->where('empresa_id', '=', Empresa::get()->id);
	}
}
