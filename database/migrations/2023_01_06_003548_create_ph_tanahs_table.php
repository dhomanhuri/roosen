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
        Schema::create('ph_tanahs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('tanggal_sebar');
            $table->string('volume_dolomit');
            $table->date('tanggal_pengukuran');
            $table->string('ph');
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
        Schema::dropIfExists('ph_tanahs');
    }
};
