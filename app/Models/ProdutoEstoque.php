<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoEstoque extends Model
{
    protected $fillable = ['produto_id','estoque_id'];
}
