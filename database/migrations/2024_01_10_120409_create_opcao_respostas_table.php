<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('opcao_respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquete_id')->constrained('enquetes', 'id')->onDelete('cascade');
            $table->string('opcao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcao_respostas');
    }
};
