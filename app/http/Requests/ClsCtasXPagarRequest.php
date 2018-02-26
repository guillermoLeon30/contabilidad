<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClsCtasXPagarRequest extends FormRequest
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
            'cuenta'    =>  'required|max:255|CtaXPagarUnica'
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
            'cta_x_pagar_unica' => 'Se encuenta repetida la cuenta.',
        ];
    }

}
