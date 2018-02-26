<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            'nombre_empresa'        =>  'required|max:255',
            'telefono_convencional' =>  'required|max:255',
            'correo'                =>  'required|email|max:255',
            'tipo'                  =>  'required',
            'descripcion'           =>  'required',
            'direccion'             =>  'required|max:255',
            'ciudad'                =>  'required|max:255',
            'provincia'             =>  'required|max:255',
            'pais'                  =>  'required|max:255'
        ];
    }
}
