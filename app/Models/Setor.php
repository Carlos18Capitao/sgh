<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Setor extends Model
{

    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'setor',
        'ramal'
    ];

    public $sortable = ['setor','ramal'];

    public function produtosaida()
    {
        return $this->hasMany('App\Models\ProdutoSaida');
    }

    public function pedido()
    {
        return $this->hasMany('App\Models\Pedido');
    }

    public function empenho()
    {
        return $this->hasMany('App\Models\Empenho');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'user_setors');
    }
}
