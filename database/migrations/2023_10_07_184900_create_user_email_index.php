<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // it checks if the field deleted_at is filled in, if so, case returns NULL and create the index, otherwise returns deleted_at.
        // if works as unique index with where clause in Postgres.
        DB::unprepared("CREATE UNIQUE INDEX user_email_index ON users ((CASE WHEN deleted_at NOT LIKE '%:%' THEN deleted_at END));");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('user_email_index');
        });
    }
};
