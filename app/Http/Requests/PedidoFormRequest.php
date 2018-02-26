<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoFormRequest extends FormRequest
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
            'requisicao'   =>'required|min:3|max:60|unique:pedidos',
            'setor_id'   =>'required',
        ];
    }
    public function messages()
     {
         return [
             'requisicao.required'  =>'Informe o número da REQUISIÇÃO!',
             'requisicao.min'       =>'O número da REQUISIÇÃO deve conter pelo menos três caracteres!',
             'requisicao.max'       =>'O número da REQUISIÇÃO deve conter no máximo 60 caracteres!',
             'requisicao.unique'    =>'Essa REQUISIÇÃO já se encontra cadastrada!!',
             'setor_id.required'      =>'Informe o SETOR!',
         ];
     }
}
