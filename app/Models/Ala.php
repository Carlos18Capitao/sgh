<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Ala extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['descricao','ramal','created_by','updated_by'];

}
