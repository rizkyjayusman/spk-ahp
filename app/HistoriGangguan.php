<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriGangguan extends Model
{
    protected $table = 'histori_gangguan';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
    ];
    
    protected $fillable = [
        'lokasi_id',
        'kategori_gangguan_id',
        'konklusi_id',
        'awal_gangguan',
        'akhir_gangguan',
        'durasi_gangguan',
        'hasil_klasifikasi_id',
    ];

    protected $appends = [
        'hasil_klasifikasi_title'
    ];

    public function getHasilKlasifikasiTitleAttribute() {
        if($this->hasil_klasifikasi_id == 1) {
            return 'Restitusi';
        } else {
            return 'Tidak Dihitung Jam Gangguan';
        }
    }

    public $with = ['konklusi', 'kategoriGangguan', 'lokasi'];


    public function konklusi()
    {
        return $this->belongsTo(Konklusi::class);
    }

    public function kategoriGangguan()
    {
        return $this->belongsTo(KategoriGangguan::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    // public function getDurasiGangguanAttribute() {
    //     return $this->akhir_gangguan->diffInMinutes($this->awal_gangguan);
    // }
}
