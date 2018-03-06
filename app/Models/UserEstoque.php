<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEstoque extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $fillable = ['user_id','estoque_id'];
}
