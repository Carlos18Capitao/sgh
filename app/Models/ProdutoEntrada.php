<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProdutoEntrada extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = [
                        'produto_id',
                        'qtd',
                        'obs',
                        'created_by',
                        'updated_by',
                        'estoque_id',
                        'lote',
                        'validade',
                        'entrada_id'
                        ];

    public $sortable = ['produto_id','qtd','obs','created_at','lote','validade'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }

    public function user()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function estoque()
    {
        return $this->belongsTo('App\Models\Estoque');
    }

    public function entrada()
    {
        return $this->belongsTo('App\Models\Entrada');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y - h:i');
    }

    public function getValidadeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function now()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y');
        return $date;
    }

    public function getValidadeDiasAttribute()
    {
        $val = $this->attributes['validade'];
        $hoje = Carbon::now('America/Sao_Paulo');
        return Carbon::parse($hoje)->format('d/m/Y');
       // return $hoje;
      //  echo $dt->diffInDays($dt->copy()->subMonth(), false); 
      //  echo Carbon::now('America/Vancouver')->diffInSeconds(Carbon::now('Europe/London')); // 0
    }
}
