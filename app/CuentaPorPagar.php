<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaPorPagar extends Model
{
    protected $table = 'cuentas_por_pagar';

    protected $fillable = ['total', 'valor_plazo', 'fecha_vencimiento', 'tiempo_plazo'];

    //-----------------------------------------------RELACIONES-----------------------------------
    public function pagos()
    {
    	return $this->hasMany('App\Pago', 'cuentas_por_pagar_id');
    }
}
