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
        Schema::create('duties', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('person_name');
            $table->enum('shift', ['morning', 'evening']);
            $table->enum('type', ['staff', 'owner']);
            $table->foreignId('owner_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duties');
    }
};
