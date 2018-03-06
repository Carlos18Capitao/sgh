<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Pedido extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use Sortable;

    public $sotable = ['datapedido','setor_id'];

    protected $fillable = ['datapedido','created_by','updated_by','setor_id','estoque_id','requisicao'];

    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function produtosaida()
    {
        return $this->hasMany('App\Models\ProdutoSaida');
    }

    public function getDatapedidoAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
