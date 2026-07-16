<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StartupProfileApproved;
use App\Mail\StartupProfileRejected;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StartupApprovalController extends Controller
{
    public function index()
    {
        $startups = StartupProfile::with('employer')
            ->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->latest()
            ->paginate(15);

        return view('admin.startups.index', compact('startups'));
    }

    public function approve(StartupProfile $startup)
    {
        $startup->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);

        Mail::to($startup->contact_email)->send(new StartupProfileApproved($startup));

        return back()->with('success', 'Startup profile approved.');
    }

    public function reject(Request $request, StartupProfile $startup)
    {
        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $startup->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        Mail::to($startup->contact_email)->send(new StartupProfileRejected($startup));

        return back()->with('success', 'Startup profile rejected.');
    }
}