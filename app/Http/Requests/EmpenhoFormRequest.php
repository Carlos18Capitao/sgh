<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpenhoFormRequest extends FormRequest
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
            'nrempenho'     =>'required|unique:empenhos',
            'dataemissao'  =>'required',
            'valortotal'  =>'required',
            'empresa_id'  =>'required',
            'fonte'  =>'required',
            'plano'  =>'required',
            'modalidade'  =>'required',
            'setor_id'  =>'required',
        ];
    }

    public function messages()
    {
        return [
            'nrempenho.required'       =>  'Informe o número do empenho!',
            'nrempenho.unique'         =>  'Empenho já se encontra cadastrado!',
            'dataemissao.required'     =>  'Informe a data de emissão do empenho!',
            'valortotal.required'      =>  'Informe o valor total do empenho!',
            'empresa_id.required'      =>  'Selecione o fornecedor!',
            'fonte.required'           =>  'Informe a fonte!',
            'plano.required'           =>  'Informe o plano orçamentário!',
            'modalidade.required'      =>  'Selecione a modalidade do empenho!',
            'setor_id.required'        =>  'Selecione a unidade de destino do empenho!',
        ];
    }
}
