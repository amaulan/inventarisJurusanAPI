<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang');
            $table->text('desc');
            $table->integer('status');
            $table->text('status_keterangan');
            $table->integer('total');
            $table->date('tgl_masuk');
            $table->string('barcode');
            $table->integer('kategori_id')->unsigned();
            $table->integer('jurusan_id')->unsigned();
            $table->string('harga');
            $table->timestamps();

            $table->foreign('kategori_id')
            ->references('id')
            ->on('kategori')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('jurusan_id')
            ->references('id')
            ->on('jurusan')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
