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
        Schema::create('janji_temus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pasien_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['Scheduled', 'Completed'])->default('Scheduled');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('janji_temus');
    }
};
