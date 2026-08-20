<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TrainingMaterial;
use Illuminate\Http\Request;

class CourseTrainingController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        $search = $request->query('search');
        $category = $request->query('category');
        $sort = $request->query('sort', 'latest');

        /*
        |--------------------------------------------------------------------------
        | Courses
        |--------------------------------------------------------------------------
        */

        $courses = collect();

        if ($type === 'all' || $type === 'courses') {

            $courseQuery = Course::query()
                ->where('status', 'published')
                ->with('mentor');

            if ($search) {
                $courseQuery->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            }

            if ($category) {
                $courseQuery->where('category', $category);
            }

            switch ($sort) {
                case 'popular':
                    $courseQuery->orderByDesc('views_count');
                    break;

                case 'rating':
                    $courseQuery->orderByDesc('rating_avg');
                    break;

                case 'enrolled':
                    $courseQuery->orderByDesc('enrollments_count');
                    break;

                default:
                    $courseQuery->latest();
                    break;
            }

            $courses = $courseQuery->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Training Materials
        |--------------------------------------------------------------------------
        */

        $trainingMaterials = collect();

        if ($type === 'all' || $type === 'training') {

            $materialQuery = TrainingMaterial::query()
                ->where('status', 'published')
                ->with('mentor');

            if ($search) {
                $materialQuery->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            }

            if ($category) {
                $materialQuery->where('category', $category);
            }

            switch ($sort) {
                case 'popular':
                    $materialQuery->orderByDesc('views_count');
                    break;

                case 'rating':
                    $materialQuery->orderByDesc('rating_avg');
                    break;

                case 'enrolled':
                    $materialQuery->orderByDesc('downloads_count');
                    break;

                default:
                    $materialQuery->latest();
                    break;
            }

            $trainingMaterials = $materialQuery->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Combine Courses + Training Materials
        |--------------------------------------------------------------------------
        */

        $items = collect();

        foreach ($courses as $course) {
            $items->push([
                'id' => $course->id,
                'content_id' => $course->id,
                'content_type' => 'course',
                'title' => $course->title,
                'description' => $course->description,
                'category' => $course->category,
                'image' => $course->cover_image,
                'mentor' => $course->mentor,
                'rating_avg' => $course->rating_avg ?? 0,
                'rating_count' => $course->rating_count ?? 0,
                'views' => $course->views_count ?? 0,
                'secondary_count' => $course->enrollments_count ?? 0,
                'created_at' => $course->created_at,
                'lessons_count' => $course->lessons()->count(),
            ]);
        }

        foreach ($trainingMaterials as $material) {
            $items->push([
                'id' => $material->id,
                'content_id' => $material->id,
                'content_type' => 'training',
                'title' => $material->title,
                'description' => $material->description,
                'category' => $material->category,
                'image' => $material->cover_image,
                'mentor' => $material->mentor,
                'rating_avg' => $material->rating_avg ?? 0,
                'rating_count' => $material->rating_count ?? 0,
                'views' => $material->views_count ?? 0,
                'secondary_count' => $material->downloads_count ?? 0,
                'created_at' => $material->created_at,
                'lessons_count' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Sort Combined Results
        |--------------------------------------------------------------------------
        */

        switch ($sort) {

            case 'popular':
                $items = $items
                    ->sortByDesc('views')
                    ->values();
                break;

            case 'rating':
                $items = $items
                    ->sortByDesc('rating_avg')
                    ->values();
                break;

            default:
                $items = $items
                    ->sortByDesc('created_at')
                    ->values();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $courseCategories = Course::where('status', 'published')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $trainingCategories = TrainingMaterial::where('status', 'published')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $categories = $courseCategories
            ->merge($trainingCategories)
            ->unique()
            ->sort()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Counts
        |--------------------------------------------------------------------------
        */

        $courseCount = Course::where('status', 'published')->count();

        $trainingCount = TrainingMaterial::where('status', 'published')->count();

        return view('student.courses-training', compact(
            'items',
            'categories',
            'courseCount',
            'trainingCount',
            'type',
            'search',
            'category',
            'sort'
        ));
    }
}