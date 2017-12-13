<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlaFormRequest extends FormRequest
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
             'descricao'   =>'required|min:3|max:60|unique:alas',
             'ramal'       =>'required|min:4|max:20|unique:alas',
         ];
     }

     public function messages()
     {
         return [
             'descricao.required'  =>'Informe a ALA!',
             'descricao.min'       =>'A ALA deve conter pelo menos três caracteres!',
             'descricao.max'       =>'A ALA deve conter no máximo 60 caracteres!',
             'descricao.unique'    =>'Essa ALA já se encontra cadastrada!!',
             'ramal.required'      =>'Informe o RAMAL!',
             'ramal.min'           =>'O RAMAL deve conter pelo menos 4 caracteres!',
             'ramal.max'           =>'O RAMAL deve conter no máximo 20 caracteres!',
             'ramal.unique'           =>'RAMAL cadastrado para outro setor!',
         ];
     }
}
