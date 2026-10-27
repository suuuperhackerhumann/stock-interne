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
    Schema::create('hardware_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('name'); // ex: HP EliteBook 820
        $table->string('serial_number')->unique()->nullable();
        $table->enum('status', ['disponible', 'en_service', 'maintenance', 'rebut'])->default('disponible');
        $table->string('location')->nullable(); // Emplacement physique
        $table->date('purchase_date')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware_items');
    }
};
