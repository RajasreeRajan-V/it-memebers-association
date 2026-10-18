<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |------------------------------------------------------------------
        | 1. STATUS: enum/string -> string(20) default 'active'
        |------------------------------------------------------------------
        */
        Schema::table('projects', function (Blueprint $table) {
            $table->string('status', 20)->default('active')->change();
        });

        /*
        |------------------------------------------------------------------
        | 2. VISIBILITY: single value -> JSON array of values
        |------------------------------------------------------------------
        */

        // 2a. First make it a plain text column so we can safely rewrite values
        //     (works even if it was previously an enum). Requires doctrine/dbal
        //     on Laravel < 10.
        Schema::table('projects', function (Blueprint $table) {
            $table->text('visibility')->nullable()->change();
        });

        // 2b. Convert old single values into JSON arrays
        DB::table('projects')->orderBy('id')->get()->each(function ($p) {
            $old = $p->visibility;

            $new = in_array($old, ['freelancer', 'employee', 'student'], true)
                ? [$old]
                : ['freelancer', 'employee', 'student']; // old "public"/null -> everyone

            DB::table('projects')
                ->where('id', $p->id)
                ->update(['visibility' => json_encode($new)]);
        });

        // 2c. Now make it a real JSON column
        Schema::table('projects', function (Blueprint $table) {
            $table->json('visibility')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |------------------------------------------------------------------
        | 1. VISIBILITY: JSON array -> single value (first element)
        |------------------------------------------------------------------
        */
        DB::table('projects')->orderBy('id')->get()->each(function ($p) {
            $arr = json_decode($p->visibility, true) ?: [];

            DB::table('projects')
                ->where('id', $p->id)
                ->update(['visibility' => $arr[0] ?? 'freelancer']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('visibility')->nullable()->change();
        });

        /*
        |------------------------------------------------------------------
        | 2. STATUS: leave as string(20) default 'active'
        |    (restoring the old enum could truncate rows that now hold
        |     'active' or 'deactive', so we intentionally do nothing)
        |------------------------------------------------------------------
        */
    }
};