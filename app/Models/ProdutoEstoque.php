<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['produto_id','estoque_id'];

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}
