<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProdutoEntrada extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
                        'produto_id',
                        'qtd',
                        'obs',
                        'created_by',
                        'updated_by',
                        'estoque_id',
                        'lote',
                        'validade',
                        'entrada_id'
                        ];

    public $sortable = ['produto_id','qtd','obs','created_at','lote','validade'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function user()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y - h:i');
    }

}
