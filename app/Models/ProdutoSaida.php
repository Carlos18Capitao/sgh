<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProdutoSaida extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use Sortable;
//    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at','created_at'];

    protected $fillable = [
        'produto_id',
        'qtd',
        'obs',
        'created_by',
        'updated_by',
        'setor_id',
        'estoque_id',
        'pedido_id',
        'lote',
        'validade'
    ];

    public $sortable = ['produto_id','qtd','obs','created_at','setor_id','pedido_id','lote','validade'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }

    public function user()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function pedido()
    {
        return $this->belongsTo('App\Models\Pedido');
    }
    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y - h:i');
    }
}
