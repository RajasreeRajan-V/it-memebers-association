<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $internships = Internship::with('employer')
            ->where('status', 'active')
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->city, function ($query, $city) {
                $query->where('city', 'like', "%{$city}%");
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();

        return view('students.internships.index', compact('internships'));
    }
}