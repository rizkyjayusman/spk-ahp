<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konklusi extends Model
{
    protected $table = 'konklusi';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
    
    protected $fillable = [
        'title',
        'status',
    ];
}
