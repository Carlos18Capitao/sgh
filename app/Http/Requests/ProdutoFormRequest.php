<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoFormRequest extends FormRequest
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
            'produto'       =>'required|min:3',
            'unidade'       =>'required|max:100',
            'categoria_id'  =>'required',
            'codigo'        =>'unique:produtos'
        ];
    }

    public function messages()
    {
        return [
            'produto.required'  =>'Informe a descrição do produto!',
            'produto.min'       =>'A descrição do produto deve conter pelo menos três caracteres!',
            'produto.max'       =>'A descrição do produto deve conter no máximo 255 caracteres!',
            'unidade.required'  =>'Informe a descrição da unidade!',
            'unidade.max'       =>'A produto deve conter no máximo cem caracteres!',
            'categoria_id.required'      =>'Informe a quantidade!',
            'codigo.unique'     =>'Este código já está existe!'
        ];
    }
}
