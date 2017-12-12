<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPrestadorFormRequest extends FormRequest
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
             'descricao'       =>'required|min:3|max:80|unique:tipo_prestadors',
         ];
     }

     public function messages()
     {
         return [
             'descricao.required'  =>'Informe a descrição do TIPO DE PRESTADOR!',
             'descricao.min'       =>'A descrição do TIPO DE PRESTADOR deve conter pelo menos três caracteres!',
             'descricao.max'       =>'A descrição do TIPO DE PRESTADOR deve conter no máximo cem caracteres!',
             'descricao.unique'   =>'Esse TIPO DE PRESTADOR já se encontra cadastrado!',
         ];
     }
 }
