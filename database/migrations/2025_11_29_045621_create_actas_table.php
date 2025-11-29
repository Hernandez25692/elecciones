<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mesa_id')->constrained()->onDelete('cascade');

            $table->enum('nivel', ['alcalde', 'presidencial']);

            $table->string('archivo')->nullable();

            $table->integer('nacional')->default(0);
            $table->integer('liberal')->default(0);
            $table->integer('libre')->default(0);
            $table->integer('dc')->default(0);
            $table->integer('pinu')->default(0);
            $table->integer('nulos')->default(0);
            $table->integer('blancos')->default(0);

            $table->integer('total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
