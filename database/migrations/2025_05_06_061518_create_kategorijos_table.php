<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Sukuriame 'kategorijos' lentelę
        Schema::create('kategorijos', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas'); // Kategorijos pavadinimas
            $table->timestamps(); // Created at ir updated at stulpeliai
        });

        // Įterpiame pradinius duomenis į 'kategorijos' lentelę
        DB::table('kategorijos')->insert([
            ['pavadinimas' => 'Telefonai'],
            ['pavadinimas' => 'Kompiuteriai'],
            ['pavadinimas' => 'Televizoriai'],
            ['pavadinimas' => 'Buitinė technika'],
        ]);
    }

    public function down(): void
    {
        // Ištriname 'kategorijos' lentelę, jei ji egzistuoja
        Schema::dropIfExists('kategorijos');
    }
};
