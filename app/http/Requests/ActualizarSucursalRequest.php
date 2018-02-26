<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarSucursalRequest extends FormRequest
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
        $id = $this->all()['id'];

        return [
            'tipo'      => 'required|EsActualizable:'.$id,
            'direccion' => 'required',
            'ciudad'    => 'required|max:255',
        ];
    }
}
