<?php

namespace App\Models\Ata;

use Illuminate\Database\Eloquent\Model;
use GiordanoLima\DecimalMutators\DecimalMutators;

class ItemAta extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }
    use DecimalMutators;

    protected $revisionCreationsEnabled = true;

    protected $decimalsFields = [
        'precoreg',
        'qtdreg'
    ];
    protected $decimalsOptions = [
        "decimals" => 4,
    ];
    protected $fillable = ['item_id',
        'ata_id',
        'itemarp',
        'precoreg',
        'qtdreg',
        'descdoe',
        'marca',
        'unidade',
        'created_by',
        'updated_by'];

//    public function fornecedor()
//    {
//        return $this->belongsTo('App\Models\Fornecedor\Fornecedor');
//    }
    protected $dates = ['vigencia'];

    public function objeto()
    {
        return $this->belongsTo('App\Models\Objeto\Objeto');
    }
    public function ata()
    {
        return $this->belongsTo('App\Models\Ata\Ata');
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Item\Item')
            ->where('active','=','1');
    }
    public function itemprocesso()
    {
//        return $this->hasMany('App\Models\Processo\ItemProcesso')
        return $this->hasMany('App\Models\Processo\ItemProcesso')
          ->where('qtd', '>', '0')
          ->where('devolvido',0)
//            ->where('processo_id','=','5')
//            ->selectRaw('item_ata_id','qtd')
         //   ->groupby('item_ata_id') //COMENTADO PARA SOLUCIONAR PROBLEMA NO CALCULO DO SHOWATA

//            ->and('processo_id','=','id')
        ;
    }
}
