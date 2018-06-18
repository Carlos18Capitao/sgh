<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['numero','obs','created_by','updated_by','categoria_id'];

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function empenho()
    {
        return $this->hasMany('App\Models\Empenho');
    }

}
