<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pre_schedule_twods', function (Blueprint $table) {
            $table->id();
            $table->date('schedule_date');
            $table->string('open_time', 8);
            $table->string('set')->default('--');
            $table->string('value')->default('--');
            $table->string('number', 2);
            $table->string('status')->default('1');
            $table->timestamps();

            $table->unique(['schedule_date', 'open_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_schedule_twods');
    }
};
