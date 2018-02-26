<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Empresa;
use App\BodegaIngreso;

class Store extends Model
{
	protected $fillable = ['tipo', 'codigo_local_factura', 'direccion', 'ciudad', 'empresa_id'];

	//-----------------------------RELACIONES---------------------------------
    public function empresas(){
        return $this->belongsToMany('App\Empresa', 'user_empresa_store')->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany('App\User', 'user_empresa_store')->withTimestamps();
    }

    public function productStocks()
    {
        return $this->belongsToMany('App\ProductStock', 'bodegas')->withTimestamps()->withPivot('cantidad', 'ubicacion');
    }

    public function ingresos()
    {
        return $this->hasMany('App\BodegaIngreso');
    }
    //-------------------------------------------------------------------------
    
    //-------------------------------Query Scopes------------------------------
    public function scopeBuscar($query, $buscar)
    {
    	return $query->where('empresa_id', '=', Empresa::get()->id)
    				 ->where(function ($query) use($buscar){
    				 	$query->where('tipo', 'like', '%'.$buscar.'%')
    				 		  ->orWhere('direccion', 'like', '%'.$buscar.'%')
    				 		  ->orWhere('ciudad', 'like', '%'.$buscar.'%');
    				 });
    }
    //--------------------------------------------------------------------------

    //----------------------------------METODOS------------------------------------
    public function codigoFactura(){
    	return $this->where('empresa_id', '=', Empresa::get()->id)->get()->max('codigo_local_factura') + 1;
    }

    public function cambiarMatrizASucursal(){
    	$store = $this->where([
    		['empresa_id', Empresa::get()->id],
    		['tipo', 'Matriz']
    	])->first();
    	$store->tipo = 'Sucursal';
    	$store->save();
    }

    /**
     * Devuelve un arreglo para ingresar en la tabla bodegas (muchos a muchos)
     *
     * @arrProductStockId  Array
     * @arrCantidad  Array
     * @ubicaion  String
     * @return Array
     */
    public function arrProductStock($arrProductStockId, $arrCantidad, $ubicacion)
    {
        $arr = array();
        
        for ($i=0; $i < count($arrProductStockId) ; $i++) { 
            $arr[$arrProductStockId[$i]]['cantidad'] = $arrCantidad[$i] + $this->cantidad($arrProductStockId[$i]);;
            $arr[$arrProductStockId[$i]]['ubicacion'] = $ubicacion;
        }
        
        return $arr;
    }

    public function cantidad($ProductStockId)
    {
        $bodega = BodegaIngreso::where([['store_id', $this->id], 
                                     ['product_stock_id', $ProductStockId]
                            ])->get()->first();

        return (is_null($bodega))?0:$bodega->cantidad;
    }
}
