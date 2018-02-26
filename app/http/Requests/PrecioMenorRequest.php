<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecioMenorRequest extends FormRequest
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
        return [
            'dimensiones'                              =>  'required|array',
            'precio.costo'                             =>  'required|numeric|min:1',
            'precio.ganancia_por_menor'                =>  'required_without:precio.ganancia_por_mayor|numeric|min:1',
            'precio.pocentaje_ganancia_por_menor'      =>  'required_without:precio.pocentaje_ganancia_por_mayor|numeric|min:1',
            'precio.descuento_por_menor'               =>  'required_without:precio.descuento_por_mayor|numeric',
            'precio.porcentaje_descuento_por_menor'    =>  'required_without:precio.porcentaje_descuento_por_mayor|numeric',    
            'precio.precio_por_menor_inc_iva'          =>  'required_without:precio.precio_por_mayor_inc_iva|numeric|min:1',
            'precio.ganancia_por_mayor'                =>  'required_without:precio.ganancia_por_menor|numeric|min:1',
            'precio.pocentaje_ganancia_por_mayor'      =>  'required_without:precio.pocentaje_ganancia_por_menor|numeric|min:1',
            'precio.descuento_por_mayor'               =>  'required_without:precio.descuento_por_menor|numeric',
            'precio.porcentaje_descuento_por_mayor'    =>  'required_without:precio.porcentaje_descuento_por_menor|numeric',    
            'precio.precio_por_mayor_inc_iva'          =>  'required_without:precio.precio_por_menor_inc_iva|numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
                'precio.costo.min'                                  =>  'El costo debe ser mayor a cero.',
                'precio.ganancia_por_menor.min'                     =>  'La ganancia debe ser mayor a cero.',
                'precio.pocentaje_ganancia_por_menor.min'           =>  'El porcentaje de ganancia debe ser mayor que cero',
                'precio.precio_por_menor_inc_iva.min'               =>  'El precio debe ser mayor a cero.',
                'precio.costo.required'                             =>  'El costo es obligatorio.',
                'precio.ganancia_por_menor.required'                =>  'La ganancia es obligatoria.',
                'precio.pocentaje_ganancia_por_menor.required'      =>  'El porcentaje de ganancia es obligatorio.',
                'precio.descuento_por_menor.required'               =>  'El descuento es obligatorio.',
                'precio.porcentaje_descuento_por_menor.required'    =>  'El porcentaje de descuento es obligatorio.',    
                'precio.precio_por_menor_inc_iva.required'          =>  'El precio es obligatorio.',
                'precio.ganancia_por_mayor.min'                     =>  'La ganancia debe ser mayor a cero.',
                'precio.pocentaje_ganancia_por_mayor.min'           =>  'El porcentaje de ganancia debe ser mayor que cero',
                'precio.precio_por_mayor_inc_iva.min'               =>  'El precio debe ser mayor a cero.',
                'precio.ganancia_por_mayor.required'                =>  'La ganancia es obligatoria.',
                'precio.pocentaje_ganancia_por_mayor.required'      =>  'El porcentaje de ganancia es obligatorio.',
                'precio.descuento_por_mayor.required'               =>  'El descuento es obligatorio.',
                'precio.porcentaje_descuento_por_mayor.required'    =>  'El porcentaje de descuento es obligatorio.',    
                'precio.precio_por_mayor_inc_iva.required'          =>  'El precio es obligatorio.'
        ];
    }
}
