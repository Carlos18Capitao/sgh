<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Categoria extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'descricao',
    ];

    public $sortable = ['descricao'];

    public function produto()
    {
        return $this->hasMany('App\Models\Produto');
    }
}
