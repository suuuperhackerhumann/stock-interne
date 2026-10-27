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
    Schema::create('assignments', function (Blueprint $table) {
        $table->id();
        $table->morphs('item'); // Lie soit un matériel, soit une licence de manière dynamique
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'employé destinataire
        $table->foreignId('distributor_id')->constrained('users')->onDelete('cascade'); // Le distributeur
        $table->text('reason'); // Motif de l'attribution
        $table->string('pdf_path')->nullable(); // Chemin du PDF de décharge
        $table->timestamp('assigned_at')->useCurrent();
        $table->timestamp('returned_at')->nullable(); // Date de restitution (si rendu)
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
