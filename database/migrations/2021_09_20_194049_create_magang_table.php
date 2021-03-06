<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_mahasiswa');
            $table->bigInteger('id_dosen')->nullable();
            $table->string('nilai_matkul');
            $table->string('url_transkrip');
            $table->text('url_laporan')->nullable();
            $table->float('ipk');
            $table->bigInteger('id_sekolah')->nullable();
            $table->enum('status_pengajuan', ['proses','ditolak', 'diterima', 'selesai','gagal']);
            $table->char('nilai_pembimbing')->nullable();
            $table->string('keterangan_status')->nullable();
            $table->bigInteger('id_periode');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magang');
    }
}
