<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Produto extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['produto','unidade','categoria_id','created_by','updated_by','lote','validade','codigo'];

    public $sortable = ['produto','unidade','categoria_id','codigo'];

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

    public function estoque()
    {
        return $this->belongsToMany('App\Models\Estoque', 'produto_estoques');
    }

    public function produtoestoque()
    {
        return $this->hasMany('App\Models\ProdutoEstoque');
    }

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
