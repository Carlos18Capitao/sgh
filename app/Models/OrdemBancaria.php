<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemBancaria extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = ['fornecedor_id','processo','empenho','valor','nf','emissaonf','created_by','updated_by'];

  public function getValorFormattedAttribute()
  {
    $valor = $this->attributes['valor'];

    return number_format($valor, 2,',','.');
  }
}
