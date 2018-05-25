<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Produto extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public static function boot()
    {
        parent::boot();
    }

    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['produto','unidade','categoria_id','created_by','updated_by','lote','validade','codigo'];

    public $sortable = ['produto','unidade','categoria_id','codigo'];

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function produtoentrada()
    {
        return $this->hasMany('App\Models\ProdutoEntrada');
    }

    public function produtosaida()
    {
        return $this->hasMany('App\Models\ProdutoSaida');
    }

    public function estoque()
    {
        return $this->belongsToMany('App\Models\Estoque', 'produto_estoques');
    }

    public function produtoestoque()
    {
        return $this->hasMany('App\Models\ProdutoEstoque');
    }

    public function itemempenho()
    {
        return $this->hasMany('App\Models\ItemEmpenho');
    }

    public function lotes()
    {
        return $this->hasMany('App\Models\Lotes');
    }

    public function getLoteFormattedAttribute()
    {
        $lote = $this->attributes['lote'];

        if($lote == 1) {
            return 'Sim';
        } else {
            return 'Não'; }
    }

    public function getValidadeFormattedAttribute()
    {
        $validade = $this->attributes['validade'];

        if($validade == 1) {
            return 'Sim';
        } else {
            return 'Não'; }
    }

    public function now()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('d/m/Y');
        return $date;
    }
    public function getLimitarTextoAttribute($texto,$limite,$quebrar = true){
        //$texto = $this->attributes['produto'];
        //$limite = 50;

        //corta as tags do texto para evitar corte errado
        $contador = strlen(strip_tags($texto));
        if($contador <= $limite):
            //se o número do texto form menor ou igual o limite então retorna ele mesmo
            $newtext = $texto;
        else:
            if($quebrar == true): //se for maior e $quebrar for true
                //corta o texto no limite indicado e retira o ultimo espaço branco
                $newtext = trim(mb_substr($texto, 0, $limite))."...";
            else:
                //localiza ultimo espaço antes de $limite
                $ultimo_espaço = strrpos(mb_substr($texto, 0, $limite)," ");
                //corta o $texto até a posição lozalizada
                $newtext = trim(mb_substr($texto, 0, $ultimo_espaço))."...";
            endif;
        endif;
        return $newtext;
    }

}
