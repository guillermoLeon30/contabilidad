<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodegaIngresoRequest extends FormRequest
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
            'datos.envio_id'        =>  'required|integer',
            'datos.fecha'           =>  'required|Fecha',
            'datos.ubicacion'       =>  'required',
            'items.cantProducto'    =>  'required|EsArregloMayorCero'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'datos.envio_id.required'               =>  'Se debe de ingresar un código de envío.',
            'datos.envio_id.integer'                =>  'Se debe de ingresar un numero entero en el código de envío.',
            'datos.fecha.required'                  =>  'Se debe de ingresar el campo fecha',
            'datos.ubicacion.required'              =>  'Se debe de ingresar una ubicación para los productos.',
            'items.cantProducto.required'           =>  'Se deben de ingresar prodcutos',
            'items.cantProducto.EsArregloMayorCero' =>  'Las cantidades de los productos deben ser números mayores a cero'
        ];
    }
}
