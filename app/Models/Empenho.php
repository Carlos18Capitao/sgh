<?php

namespace App\Models;

use GiordanoLima\DecimalMutators\DecimalMutators;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Processo;
use Carbon\Carbon;

class Empenho extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    use DecimalMutators;

    protected $decimalsFields = ['valortotal'];

    public static function boot()
    {
        parent::boot();
    }

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['nrempenho','dataemissao','valortotal','modalidade','fonte','plano','processo_id','empresa_id','obs','created_by','updated_by','setor_id'];

    protected $dates = ['dataemissao'];

    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
    public function itemempenho()
    {
        return $this->hasMany('App\Models\ItemEmpenho');
    }
    public function processo()
    {
        return $this->belongsTo('App\Models\Processo');
    }

    public function setor()
    {
        return $this->belongsTo('App\Models\Setor');
    }

    public function getDataEmissaoAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function entrada()
    {
        return $this->hasMany('App\Models\Entrada');
    }
}
