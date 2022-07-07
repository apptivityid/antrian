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
        Schema::create('coas', function (Blueprint $table) {
            $table->string('nomor')->primary();
            $table->string('nama');
            $table->string('nomorgrupcoa')->nullable();
            $table->string('nomortipetanaman')->nullable();
            $table->string('nomorstatuslahan')->nullable();
            $table->string('kategoricoa')->nullable();
            $table->string('nomortipeakun')->nullable();
            $table->string('nomorposisikeuangan')->nullable();
            $table->string('nomorlabarugi')->nullable();
            $table->string('kepemilikancoa')->nullable();
            $table->string('satuan')->nullable();
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
        Schema::dropIfExists('coas');
    }
};
