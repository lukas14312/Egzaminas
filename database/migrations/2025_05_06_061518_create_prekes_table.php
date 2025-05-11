<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prekes', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
            $table->text('aprasymas')->nullable();
            $table->decimal('kaina', 8, 2);
            $table->string('prek_kodas')->unique(); // unikalus prekės kodas
            $table->string('nuotrauka')->nullable();
            $table->unsignedBigInteger('kategorija_id');
            $table->timestamps();

            $table->foreign('kategorija_id')->references('id')->on('kategorijos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prekes');
    }
};
