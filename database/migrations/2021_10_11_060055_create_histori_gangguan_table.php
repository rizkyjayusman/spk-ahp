<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriGangguanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_gangguan', function (Blueprint $table) {
            $table->id();
            $table->integer('lokasi_id');
            $table->integer('kategori_gangguan_id');
            $table->integer('konklusi_id');
            $table->dateTime('awal_gangguan');
            $table->dateTime('akhir_gangguan');
            $table->integer('durasi_gangguan');
            $table->integer('hasil_klasifikasi_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histori_gangguan');
    }
}
