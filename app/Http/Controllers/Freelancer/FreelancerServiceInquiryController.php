<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerServiceInquiry;
use Illuminate\Http\Request;

class FreelancerServiceInquiryController extends Controller
{
    public function index(Request $request)
    {
        $inquiries = FreelancerServiceInquiry::query()
            ->whereHas('service', fn ($q) => $q->where('user_id', $request->user()->id))
            ->with(['service:id,title,user_id', 'user:id,name,email'])
            ->latest()
            ->paginate(15);

        return view('freelancer.services.inquiries', compact('inquiries'));
    }
}