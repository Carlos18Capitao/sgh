<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Entrada extends Model
{
    use Sortable;

    public $sotable = ['datapedido','setor_id'];

    protected $fillable = ['tipoentrada','numeroentrada','dataentrada','empresa_id','estoque_id','created_by','updated_by','preco'];

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }
}
