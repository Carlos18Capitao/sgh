<?php

namespace App\Models\Fornecedor;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = ['nome',
                            'cnpj',
                            'email',
                            'telefone',
                            'endereco',
                            'area',
                            'responsavel',
                            'created_by',
                            'updated_by'];

    public function atas()
    {
        return $this->hasMany('App\Models\Ata\Ata');
    }

    public function getCnpjAttribute($value)
    {
        return preg_replace('@[./-]@', '', $value);
    }

}
