<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'created_by',
        'updated_by',
        'estoque_id',
        'setor_id',
        'tipo'
    ];

}
