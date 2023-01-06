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
        Schema::create('pemupukans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('tanggal_pemupukan');
            $table->string('jenis_pupuk');
            $table->string('volume_pupuk');
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
        Schema::dropIfExists('pemupukans');
    }
};
