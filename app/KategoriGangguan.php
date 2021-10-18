<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriGangguan extends Model
{
    protected $table = 'kategori_gangguan';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
    
    protected $fillable = [
        'title',
        'status',
    ];
}
