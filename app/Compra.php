<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\ProductStock;

class Compra extends Model
{
    protected $fillable = ['provider_id', 'fecha_compra', 'factura', 'monto_no_facturado', 'monto_facturado', 'iva_compra', 'retencion_iva', 'retencion_renta', 'porcentaje_retencion_iva', 'porcentaje_retencion_renta'];

    //-------------------------------------------RELACIONES---------------------------------------
    public function proveedor()
    {
        return $this->belongsTo('App\Provider', 'provider_id');
    }

    public function items()
    {
        return $this->hasMany('App\ItemsCompra');
    }

    public function envios()
    {
        return $this->hasMany('App\Envio');
    }

    public function CuentaPorPagar()
    {
        return $this->hasMany('App\CuentaPorPagar');
    }

    //--------------------------------------ALCANCE DE DATOS--------------------------------------
    public function scopeBuscar($query, $fechaInicial, $fechaFinal, $provedorId)
    {
        if (empty($fechaInicial) || empty($fechaFinal)) {
            return $query->where('provider_id', $provedorId);
        }elseif (empty($provedorId)){
            $fechaInicial = Carbon::createFromFormat('d/m/Y', $fechaInicial)->toDateString();
            $fechaFinal = Carbon::createFromFormat('d/m/Y', $fechaFinal)->toDateString();

            return $query->whereDate('fecha_compra', '>=', $fechaInicial)
                         ->whereDate('fecha_compra', '<=', $fechaFinal);
        }else{
            $fechaInicial = Carbon::createFromFormat('d/m/Y', $fechaInicial)->toDateString();
            $fechaFinal = Carbon::createFromFormat('d/m/Y', $fechaFinal)->toDateString();
            
            return $query->where('provider_id', $provedorId)
                         ->where(function ($query) use($fechaInicial, $fechaFinal){
                             $query->whereDate('fecha_compra', '>=', $fechaInicial)
                                   ->whereDate('fecha_compra', '<=', $fechaFinal);
                         });    
        }
    }

    //-------------------------------------------METODOS------------------------------------------
    public function idProductStock($idProducto, $idStock, $color)
    {
    	return ProductStock::where([
    			['product_id', $idProducto],
    			['stock_id', $idStock],
    			['color', $color]
    		])->get()->first()->id;
    }

    public function total()
    {
        $suma = $this->monto_facturado + $this->monto_no_facturado + $this->iva_compra - $this->retencion_renta - $this->retencion_iva;

        return number_format($suma, 2);
    }

    public function fecha()
    {
        return Carbon::createFromFormat('Y-m-d', $this->fecha_compra)->format('d/m/Y');
    }

    public function subTotal()
    {
        return $this->items->map(function ($item, $key){
            return $item->precio * $item->cantidad;
        })->sum();
    }
}
