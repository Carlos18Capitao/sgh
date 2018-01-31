<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
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
