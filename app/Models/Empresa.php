<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $fillable = ['nome','cnpj','email','telefone','endereco','area','responsavel','created_by','updated_by'];

    public function entrada()
    {
        return $this->hasMany('App\Models\Entrada');
    }
}
