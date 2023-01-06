<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_produksis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('tanggal_panen');
            $table->string('jumlah_pohon');
            $table->string('jumlah_bunga');
            $table->string('ukuran_kelopak');
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
        Schema::dropIfExists('hasil_produksis');
    }
};
