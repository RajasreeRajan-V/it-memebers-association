<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds 'approved' to training_materials.status, completing the
     * mentor -> admin review lifecycle:
     *   pending  -> mentor submitted, awaiting admin review
     *   approved -> admin approved, not yet published to mentees
     *   published -> live and visible to mentees
     *   rejected -> admin rejected (see admin_remarks for reason)
     *
     * NOTE: confirm this list matches every value your app currently
     * uses for this column before running (check earlier migrations
     * for this table if unsure).
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE training_materials
            MODIFY COLUMN status
            ENUM('pending', 'approved', 'published', 'rejected')
            NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * Rolls back to the enum without 'approved'. If any rows currently
     * hold 'approved', this will fail unless you first convert those
     * rows to another status.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE training_materials
            MODIFY COLUMN status
            ENUM('pending', 'published', 'rejected')
            NOT NULL DEFAULT 'pending'");
    }
};
