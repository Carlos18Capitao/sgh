<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetors extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['user_id','setor_id'];
}
