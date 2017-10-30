<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class TipoPrestadors extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['descricao',
                            'created_by',
                            'updated_by'];
}
