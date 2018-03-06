<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $fillable = ['numero','obs','created_by','updated_by'];
}
