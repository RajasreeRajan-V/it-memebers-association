<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreelancerService;
class FreelancerMarketPlaceController extends Controller
{
     public function index(Request $request)
    {
        $services = FreelancerService::approved()->with('user')
            ->when($request->category, fn ($q, $c) => $q->where('category', $c))
            ->when($request->q, function ($q, $term) {
                $q->where(fn ($w) => $w->where('title', 'like', "%$term%")
                    ->orWhere('skills', 'like', "%$term%")
                    ->orWhere('description', 'like', "%$term%"));
            })
            ->latest()->paginate(12)->withQueryString();

        return view('employers.freelancer.services.index', compact('services'));
    }

    public function show(FreelancerService $service)
    {
        abort_unless($service->status === 'approved', 404);
        return view('employers.freelancer.services.show', compact('service'));
    }

    public function inquire(Request $request, FreelancerService $service)
    {
        abort_unless($service->status === 'approved', 404);
        $data = $request->validate(['message' => ['required', 'string', 'min:10', 'max:2000']]);
        $service->inquiries()->create($data + ['user_id' => $request->user()->id]);
        // TODO: notify $service->user (Mail/Notification) about the new inquiry.
        return back()->with('status', 'Inquiry sent to the freelancer.');
    }
}
