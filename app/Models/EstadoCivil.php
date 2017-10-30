<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EstadoCivil extends Model
{
    use Sortable;

    protected $fillable = ['descricao'];

    public $sortable = ['descricao'];
}
