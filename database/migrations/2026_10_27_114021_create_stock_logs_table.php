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
    Schema::create('stock_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Qui a fait l'action
        $table->string('action'); // ex: 'ENTREE', 'ATTRIBUTION', 'MODIFICATION', 'SUPPRESSION'
        $table->string('item_type'); // ex: 'Matériel', 'Licence'
        $table->string('item_name'); // Nom ou Numéro de série de l'équipement
        $table->text('description'); // Détail complet de l'action
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
