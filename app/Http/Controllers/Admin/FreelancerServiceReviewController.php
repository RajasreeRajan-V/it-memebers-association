<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreelancerService;
use Illuminate\Http\Request;

class FreelancerServiceReviewController extends Controller
{
    public function index()
    {
        $services = FreelancerService::pending()->with('user')->oldest()->paginate(12);

        return view('admin.freelancer.services.freelancer_services', compact('services'));
    }

    public function approve(Request $request, FreelancerService $service)
    {
        $service->update([
            'status' => 'approved',
            'rejection_reason' => null,
            'reviewed_by' => auth('admin')->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('status', 'Service approved and published.');
    }

    public function reject(Request $request, FreelancerService $service)
    {
        $data = $request->validate(['rejection_reason' => ['required', 'string', 'max:500']]);

        $service->update($data + [
            'status' => 'rejected',
            'reviewed_by' => auth('admin')->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('status', 'Service rejected.');
    }
}