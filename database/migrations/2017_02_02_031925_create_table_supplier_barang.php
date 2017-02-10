<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSupplierBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('barang_id')->unsigned();
            $table->timestamps();

            $table->foreign('supplier_id')
            ->references('id')
            ->on('supplier')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('barang_id')
            ->references('id')
            ->on('barang')
            ->onDelete('cascade')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_barang');
    }
}
