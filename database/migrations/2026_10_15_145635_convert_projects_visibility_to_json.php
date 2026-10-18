<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Change status to VARCHAR
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE projects
            MODIFY COLUMN status VARCHAR(20)
            NOT NULL DEFAULT 'active'
        ");

        /*
        |--------------------------------------------------------------------------
        | 2. Change visibility to TEXT BEFORE updating any values
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE projects
            MODIFY COLUMN visibility TEXT NULL
        ");

        /*
        |--------------------------------------------------------------------------
        | 3. Convert existing visibility values to JSON arrays
        |--------------------------------------------------------------------------
        */

        $projects = DB::table('projects')
            ->select('id', 'visibility')
            ->orderBy('id')
            ->get();

        foreach ($projects as $project) {
            $old = $project->visibility;

            $decoded = is_string($old)
                ? json_decode($old, true)
                : null;

            if (is_array($decoded) && array_is_list($decoded)) {
                $visibility = array_values(array_intersect(
                    $decoded,
                    ['freelancer', 'employee', 'student']
                ));

                if (empty($visibility)) {
                    $visibility = [
                        'freelancer',
                        'employee',
                        'student',
                    ];
                }
            } elseif (in_array(
                $old,
                ['freelancer', 'employee', 'student'],
                true
            )) {
                $visibility = [$old];
            } else {
                // Legacy public, NULL, or unknown values.
                $visibility = [
                    'freelancer',
                    'employee',
                    'student',
                ];
            }

            DB::table('projects')
                ->where('id', $project->id)
                ->update([
                    'visibility' => json_encode($visibility),
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Convert TEXT to a real JSON column
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE projects
            MODIFY COLUMN visibility JSON NULL
        ");
    }

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Convert JSON arrays back to single visibility values
        |--------------------------------------------------------------------------
        */

        DB::statement("
            ALTER TABLE projects
            MODIFY COLUMN visibility TEXT NULL
        ");

        $projects = DB::table('projects')
            ->select('id', 'visibility')
            ->orderBy('id')
            ->get();

        foreach ($projects as $project) {
            $values = json_decode(
                $project->visibility ?? '[]',
                true
            );

            $visibility = is_array($values) && !empty($values)
                ? $values[0]
                : 'freelancer';

            DB::table('projects')
                ->where('id', $project->id)
                ->update([
                    'visibility' => $visibility,
                ]);
        }

        DB::statement("
            ALTER TABLE projects
            MODIFY COLUMN visibility VARCHAR(255) NULL
        ");

        // Keep status as VARCHAR(20).
    }
};
