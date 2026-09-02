<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobPost::with('employer')
            ->where('is_active', true)
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->city, function ($query, $city) {
                $query->where('city', 'like', "%{$city}%");
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();

        return view('students.jobs.index', compact('jobs'));
    }
}