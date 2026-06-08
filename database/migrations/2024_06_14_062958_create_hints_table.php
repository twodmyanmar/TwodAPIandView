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
        Schema::create('hints', function (Blueprint $table) {
            $table->id();
            $table->string('money');
            $table->string('morden');
            $table->string('internet');
            $table->date('date')->default(date('Y-m-d'));
            $table->time('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hints');
    }
};
