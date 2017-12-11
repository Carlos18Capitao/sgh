<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoEntradaFormRequest extends FormRequest
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
            'produto_id'=>'required',
            'qtd'       =>'required|min:1|max:15',
        ];
    }

    public function messages()
    {
        return [
            'produto_id.required'=>'Selecione um produto!',
            'qtd.required'       =>'Informe a quantidade!',
        ];
    }
}
