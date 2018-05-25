<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lotes extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function getValidadeFormatAttribute()
    {
        $val = $this->attributes['validade'];
        
        return Carbon::parse($val)->format('d/m/Y');
    }
}
