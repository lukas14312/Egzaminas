<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('uzsakymai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('preke_id');
            $table->integer('kiekis');
            $table->string('imones_kodas');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('preke_id')->references('id')->on('prekes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uzsakymai');
    }
};
