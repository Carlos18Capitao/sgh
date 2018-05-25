<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessoFormRequest extends FormRequest
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
            'numero'        =>'required|unique:processos',
            'categoria_id'  =>'required',
        ];
    }

    public function messages()
    {
        return [
            'numero.required'       =>  'Informe o número do processo!',
            'numero.unique'         =>  'Processo já se encontra cadastrado!',
            'categoria_id.required' =>  'Selecione uma categoria!',
        ];
    }
}
