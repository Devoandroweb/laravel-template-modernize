<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi')->autoIncrement();
            $table->string('judul');
            $table->text('isi')->nullable();
            $table->text('gambar')->nullable();
            $table->timestamps();
        });

        Schema::create('latihan', function (Blueprint $table) {
            $table->id('id_latihan')->autoIncrement();;
            $table->string('pertanyaan');
            $table->string('bobot');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('jawaban');
            $table->timestamps();
        });

        Schema::create('nilai_latihan', function (Blueprint $table) {
            $table->id('id_nilai_latihan')->autoIncrement();;
            $table->string('nis',10);
            $table->integer('id_latihan');
            $table->integer('nilai');
            $table->timestamps();
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->id('id_guru')->autoIncrement();;
            $table->string('nip',10);
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas')->autoIncrement();;
            $table->string('nama');
            $table->integer('tingkatan');
            $table->timestamps();
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa')->autoIncrement();;
            $table->string('nis');
            $table->string('nama');
            $table->string('kelas');
            $table->timestamps();
        });

        Schema::create('permainan', function (Blueprint $table) {
            $table->id('id_permainan')->autoIncrement();;
            $table->string('image')->nullable();
            $table->string('pertanyaan');
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
        Schema::dropIfExists('materi');
        Schema::dropIfExists('latihan');
        Schema::dropIfExists('nilai_latihan');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('permainan');
    }
};
