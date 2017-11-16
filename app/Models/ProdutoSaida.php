<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProdutoSaida extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'produto_id',
        'qtd',
        'obs',
        'created_by',
        'updated_by',
        'setor_id'
    ];

    public $sortable = ['produto_id','qtd','obs','created_at','setor_id'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }
}
