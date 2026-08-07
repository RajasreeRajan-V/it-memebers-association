<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds 'draft' and 'rejected' to the training_materials.status enum,
     * alongside whatever values already exist (pending, published, archived, ...).
     *
     * NOTE: adjust the value list below to match every value your app
     * currently uses for this column before running this migration.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE training_materials
            MODIFY COLUMN status
            ENUM('pending', 'draft', 'published', 'rejected', 'archived')
            NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * Rolls back to the original enum. If any rows currently hold
     * 'draft' or 'rejected', this will fail (or truncate) unless you
     * first convert/remove those rows.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE training_materials
            MODIFY COLUMN status
            ENUM('pending', 'published', 'archived')
            NOT NULL DEFAULT 'pending'");
    }
};
