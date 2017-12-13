<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class TipoAlta extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['codigo','descricao','created_by','updated_by'];

    protected $sortable = ['codigo','descricao'];
}
