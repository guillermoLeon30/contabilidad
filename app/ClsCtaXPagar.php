<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;

class ClsCtaXPagar extends Model
{
    protected $table = 'cls_ctas_x_pagar';

    protected $fillable = ['empresa_id', 'cuenta'];

    //-------------------------ALCANCE DE DATOS--------------------------------
	public function scopeClsCtasXPagar($query)
	{
		return $query->where('empresa_id', '=', Empresa::get()->id);
	}
}
