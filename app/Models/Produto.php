<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Produto extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['produto','unidade','categoria_id','created_by','updated_by'];

    public $sortable = ['produto','unidade','categoria_id'];

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function produtoentrada()
    {
        return $this->hasMany('App\Models\ProdutoEntrada');
    }

    public function produtosaida()
    {
        return $this->hasMany('App\Models\ProdutoSaida');
    }
}
