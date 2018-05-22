<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GiordanoLima\DecimalMutators\DecimalMutators;


class ItemEmpenho extends Model
{
    
    use DecimalMutators;

    protected $fillable = [
        'empenho_id',
        'produto_id',        
        'qtd',
        'preco',
        'status',
        'created_by',
        'updated_by',
        ];

    protected $decimalsFields = [
            'preco'
        ];
    protected $decimalsOptions = [
            "decimals" => 4,
        ];

    public function empenho()
    {
        return $this->belongsTo('App\Models\Empenho');
    }
}
