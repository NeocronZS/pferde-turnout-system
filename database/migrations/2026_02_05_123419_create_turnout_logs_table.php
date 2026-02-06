<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('turnout_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horse_id')->constrained()->onDelete('cascade');
            $table->foreignId('duty_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('pasture_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('brought_out_at')->nullable();
            $table->timestamp('brought_in_at')->nullable();
            $table->boolean('skipped')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnout_logs');
    }
};
