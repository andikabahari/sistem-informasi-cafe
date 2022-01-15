<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->double('total');
            $table->double('tunai');
            $table->double('kembali');
            $table->unsignedInteger('id_pengguna')->nullable();
            $table->foreign('id_pengguna')
                    ->references('id_pengguna')->on('pengguna')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->unsignedInteger('id_pesanan')->nullable();
            $table->foreign('id_pesanan')
                    ->references('id_pesanan')->on('pesanan')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
