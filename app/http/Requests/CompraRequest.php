<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $monto_facturado = $this->all()['compra']['monto_facturado'];
        $monto_no_facturado = $this->all()['compra']['monto_no_facturado'];
        $retiene = $this->all()['compra']['retiene'];

        return [
            'compra.provider_id'                =>  'required|numeric',
            'compra.fecha_compra'               =>  'required|fecha',
            'compra.factura'                    =>  'required|max:255',
            'compra.monto_no_facturado'         =>  'numeric|min:0|RequeridoSiValorYcampoCero:'.$monto_facturado,
            'compra.monto_facturado'            =>  'numeric|min:0|RequeridoSiValorYcampoCero:'.$monto_no_facturado,
            'compra.iva_compra'                 =>  'numeric|min:0|IvaRequerido:'.$monto_facturado,
            'compra.retencion_iva'              =>  'numeric|min:0|RequeridoSiHayRetencion:si,'.$retiene,
            'compra.retencion_renta'            =>  'numeric|min:0|RequeridoSiHayRetencion:si,'.$retiene,
            'compra.porcentaje_retencion_iva'   =>  'numeric|min:0RequeridoSiHayRetencion:si,'.$retiene,
            'compra.porcentaje_retencion_renta' =>  'numeric|min:0|RequeridoSiHayRetencion:si,'.$retiene,
            //-------------------------------------------------------------------------------------
            'cuentaXPagar.total'                =>  'required|numeric|min:0',
            'cuentaXPagar.valor_plazo'          =>  'required|integer|min:1',
            'cuentaXPagar.fecha_vencimiento'    =>  'required|fecha',
            'cuentaXPagar.tiempo_plazo'         =>  'required',
            //--------------------------------------------------------------------------------------
            'items'                             =>  'required|array',
            'items.idProducto'                  =>  'required|EsArregloNumerico',
            'items.idStock'                     =>  'required|EsArregloNumerico',
            'items.color'                       =>  'required',
            'items.cantProducto'                =>  'required|EsArregloNumerico',
            //--------------------------------------------------------------------------------------
            'pagos'                             =>  'required|array',
            'pagos.fecha'                       =>  'required|EsArregloFechas',
            'pagos.idTipoPago'                  =>  'required|EsArregloNumerico',
            'pagos.montoPago'                   =>  'required|EsArregloNumerico'
        ];
    }
}
