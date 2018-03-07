<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Estoque extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['descricao','lote','validade','created_by','updated_by'];

    protected $sortable = ['id','descricao','lote','validade'];

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

    public function user()
    {
        return $this->belongsToMany('App\User', 'user_estoques');
    }

    public function produto()
    {
        return $this->belongsToMany('App\Models\Produto', 'produto_estoques');
    }

    public function produtoentrada()
    {
        return $this->hasMany('App\Models\ProdutoEntrada');
    }

    public function saida()
    {
        return $this->hasMany('App\Models\ProdutoSaida');
    }

    public function now()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y');
        return $date;
    }
}
