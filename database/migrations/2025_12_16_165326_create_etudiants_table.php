<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('filiere');
            $table->integer('niveau');
            $table->foreignId('enseignant_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
