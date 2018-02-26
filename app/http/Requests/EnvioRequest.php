<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnvioRequest extends FormRequest
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
            'datos.fecha'       =>  'required|fecha',
            'items.cantidad'    =>  'required|EsArregloMayorCero',
            'items'             =>  'EsValidoCantidadEnvio'
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
            'es_valido_cantidad_envio'   =>  'La cantidad ingresada es mayor a la cantidad disponible.'
        ];
    }
}
