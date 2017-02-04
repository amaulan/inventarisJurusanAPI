<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBarangRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_ruangan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ruangan_id')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('ruangan_id')
            ->references('id')
            ->on('ruangan')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('barang_id')
            ->references('id')
            ->on('barang')
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
        Schema::dropIfExists('barang_ruangan');
    }
}
