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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->string('description');
            $table->string('title');
            $table->timestamp('starting_at')->nullable()->comment('starting date');
            $table->timestamp('due_at')->nullable()->comment('due date');
            $table->timestamp('conclusion_at')->nullable()->comment('conclusion date');
            $table->char('status', 1)->comment('status - aberto/concluido');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
