<?php

namespace App\Models\Ata;

use Illuminate\Database\Eloquent\Model;
use App\Models\Processo\Processo;
//use Carbon\Carbon;

class Ata extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['plano_id',
                            'fornecedor_id',
                            'pls',
                            'arp',
                            'vigencia',
                            'objeto_id',
                            'qtditens',
                            'user',
                            'obs',
                            'created_by',
                            'updated_by'];

    protected $dates = ['vigencia'];


//class Carbon extends \DateTime
//{
//$now = Carbon::now();
//}


    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor\Fornecedor');
    }
    public function objeto()
    {
        return $this->belongsTo('App\Models\Objeto\Objeto');
    }
    public function itemata()
    {
        return $this->hasMany('App\Models\Ata\ItemAta');
    }
    public function processo()
    {
        return $this->hasMany('App\Models\Processo\Processo');
    }
}
