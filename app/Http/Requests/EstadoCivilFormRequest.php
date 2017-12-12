<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoCivilFormRequest extends FormRequest
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
             'descricao'       =>'required|min:3|max:150|unique:estado_civils',
         ];
     }

     public function messages()
     {
         return [
             'descricao.required'  =>'Informe o ESTADO CIVIL!',
             'descricao.min'       =>'O ESTADO CIVIL deve conter pelo menos três caracteres!',
             'descricao.max'       =>'O ESTADO CIVIL deve conter no máximo cento e cinquenta caracteres!',
             'descricao.unique'    =>'Esse ESTADO CIVIL já se encontra cadastrado!!',
         ];
     }
}
