<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datas extends Model
{
    protected $fillable = [
        'id', 'user_id', 'created_at','description','to','token'
    ];
    public $timestamps = false;
}
