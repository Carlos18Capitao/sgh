<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoAltaFormRequest extends FormRequest
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
             'descricao'       =>'required|min:10|max:80|unique:tipo_altas',
             'codigo'       =>'required|max:10|unique:tipo_altas',
         ];
     }

     public function messages()
     {
         return [
             'descricao.required'  =>'Informe a descrição do TIPO DE ALTA!',
             'descricao.min'       =>'A descrição do TIPO DE ALTA deve conter pelo menos dez caracteres!',
             'descricao.max'       =>'A descrição do TIPO DE ALTA deve conter no máximo cem caracteres!',
             'descricao.unique'    =>'Esse TIPO DE ALTA já se encontra cadastrado!',
             'codigo.required'     =>'Informe o CÓDIGO DA ALTA!',
             'codigo.max'          =>'O CÓDIGO deve conter no máximo dez caracteres!',
             'codigo.unique'       =>'Esse CÓDIGO já se encontra cadastrado!',
         ];
     }
}
