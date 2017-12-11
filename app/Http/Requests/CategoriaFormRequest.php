<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaFormRequest extends FormRequest
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
            'descricao'       =>'required|min:3|max:150',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required'  =>'Informe a CATEGORIA!',
            'descricao.min'       =>'A CATEGORIA deve conter pelo menos três caracteres!',
            'descricao.max'       =>'A CATEGORIA deve conter no máximo cento e cinquenta caracteres!',
        ];
    }
}
