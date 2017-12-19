<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEstoque extends Model
{
    protected $fillable = ['user_id','estoque_id'];
}
