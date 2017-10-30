<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestadors extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
                        'created_by',
                        'updated_by',
                        'nome',
                        'cnes',
                        'assistente',
                        'executante',
                        'ala_id',
                        'telefone',
                        'tipo_prestador_id'
                        ];
}
