<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->increments('id_detail_pesanan');
            $table->integer('jumlah');
            $table->unsignedInteger('id_pesanan')->nullable();
            $table->foreign('id_pesanan')
                    ->references('id_pesanan')->on('pesanan')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->unsignedInteger('id_menu')->nullable();
            $table->foreign('id_menu')
                    ->references('id_menu')->on('menu')
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
        Schema::dropIfExists('detail_pesanan');
    }
}
