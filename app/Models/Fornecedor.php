<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['descricao','tipo_pessoa','cpf_cnpj','banco','agencia','conta','passnf','created_by','updated_by'];

    public function OrdemBancaria()
      {
          return $this->hasMany('App\Models\OrdemBancaria');
      }
}
