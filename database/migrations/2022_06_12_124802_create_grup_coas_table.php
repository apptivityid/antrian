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
        Schema::create('grupcoas', function (Blueprint $table) {
            $table->string('nomor')->primary();
            $table->string('nama');
            $table->string('nomorforeignkey')->nullable();
            $table->string('namaforeignkey')->nullable();
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
        Schema::dropIfExists('grupcoas');
    }
};
