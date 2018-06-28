<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['produto_id','setor_id','qtd'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }
}
