<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorFormRequest extends FormRequest
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
            'setor'       =>'required|min:3|max:150',
            'ramal'       =>'required|min:4|max:20',
        ];
    }

    public function messages()
    {
        return [
            'setor.required'  =>'Informe o SETOR!',
            'setor.min'       =>'A descrição do SETOR deve conter pelo menos três caracteres!',
            'setor.max'       =>'A descrição do SETOR deve conter no máximo cento e cinquenta caracteres!',
            'ramal.required'  =>'Informe o RAMAL!',
            'ramal.min'       =>'O RAMAL de ter pelo menos 4 caracteres!',
            'ramal.max'      =>'O RAMAL de ter no máximo 20 caracteres!',
        ];
    }
}
