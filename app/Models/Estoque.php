<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Estoque extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['descricao','lote','validade','created_by','updated_by'];

    protected $sortable = ['id','descricao','lote','validade'];

    public function getLoteFormattedAttribute()
    {
      $lote = $this->attributes['lote'];

      if($lote == 1) {
        return 'Sim';
      } else {
        return 'Não'; }

    }

    public function getValidadeFormattedAttribute()
    {
      $validade = $this->attributes['validade'];

      if($validade == 1) {
        return 'Sim';
      } else {
        return 'Não'; }

    }

}
