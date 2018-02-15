<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['nome','cnpj','email','telefone','endereco','area','responsavel','created_by','updated_by'];

    public function entrada()
    {
        return $this->hasMany('App\Models\Entrada');
    }
}
