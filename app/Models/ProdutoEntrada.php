<?php

namespace App\Models;

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
                        'updated_by'
                        ];

    public $sortable = ['produto_id','qtd','obs','created_at'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

}
