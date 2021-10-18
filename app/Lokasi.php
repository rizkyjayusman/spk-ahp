<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
    
    protected $fillable = [
        'alamat', 
    ];
}
