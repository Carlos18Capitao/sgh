<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Entrada extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use Sortable;

    public $sotable = ['dataentrada','empresa_id'];

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['tipoentrada','numeroentrada','dataentrada','empresa_id','estoque_id','created_by','updated_by','preco'];

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }

    public function produtoentrada()
    {
        return $this->hasMany('App\Models\ProdutoEntrada');
    }

    public function getDataEntradaAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
