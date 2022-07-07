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
        Schema::create('grup', function (Blueprint $table) {
            $table->bigIncrements('nomor')->autoIncrement();
            $table->string('nama');
            $table->timestamp('tglditambah');
            $table->timestamp('tgldiubah');
            $table->string('penambah')->nullable();
            $table->string('pengubah')->nullable();
            $table->softDeletes();
            $table->string('aktif', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grup');
    }
};
