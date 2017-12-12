<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Prestador extends Model
{
    use SoftDeletes, Sortable;

    protected $dates = ['deleted_at'];

    protected $fillable = ['created_by','updated_by','nome','cnes','assistente','executante','ala_id','telefone','tipo_prestador_id'];

    public $sortable = ['id','nome','cnes','assistente','executante','ala_id','telefone','tipo_prestador_id'];

    public function getAssistenteAttribute($value)
      {
        if($value == 1) {
          return 'Sim';
        } else {
          return 'Não'; }
      }
      public function getExecutanteAttribute($value)
        {
          if($value == 1) {
            return 'Sim';
          } else {
            return 'Não'; }
        }

        public function Ala()
        {
            return $this->belongsTo('App\Models\Ala');
        }

        public function TipoPrestador()
        {
            return $this->belongsTo('App\Models\TipoPrestador');
        }
}
