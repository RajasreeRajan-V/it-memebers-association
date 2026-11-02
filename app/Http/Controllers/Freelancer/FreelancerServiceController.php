<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreelancerService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FreelancerServiceRequest;
class FreelancerServiceController extends Controller
{
     public function index(Request $request)
    {
        $services = $request->user()->services()->latest()->get();
        return view('freelancer.services.index', compact('services'));
    }

    public function create()
    {
        return view('freelancer.services.form', ['service' => new FreelancerService()]);
    }

    public function store(FreelancerServiceRequest $request)
    {
        $data = $request->safe()->except('portfolio_image');
        if ($request->hasFile('portfolio_image')) {
            $data['portfolio_image'] = $request->file('portfolio_image')->store('services', 'public');
        }
        $request->user()->services()->create($data); // status defaults to pending

        return redirect()->route('freelancer.services.index')->with('status', 'Service submitted for review.');
    }

    public function edit(FreelancerService $service)
    {
        $this->own($service);
        return view('freelancer.services.form', compact('service'));
    }

    public function update(FreelancerServiceRequest $request, FreelancerService $service)
    {
        $this->own($service);
        $data = $request->safe()->except('portfolio_image');
        if ($request->hasFile('portfolio_image')) {
            if ($service->portfolio_image) Storage::disk('public')->delete($service->portfolio_image);
            $data['portfolio_image'] = $request->file('portfolio_image')->store('services', 'public');
        }
        // Any edit sends the listing back through admin review.
        $service->update($data + ['status' => 'pending', 'rejection_reason' => null]);

        return redirect()->route('freelancer.services.index')->with('status', 'Changes submitted for review.');
    }

    public function destroy(FreelancerService $service)
    {
        $this->own($service);
        if ($service->portfolio_image) Storage::disk('public')->delete($service->portfolio_image);
        $service->delete();
        return back()->with('status', 'Service deleted.');
    }

    private function own(FreelancerService $service): void
    {
        abort_unless($service->user_id === auth()->id(), 403);
    }
}
