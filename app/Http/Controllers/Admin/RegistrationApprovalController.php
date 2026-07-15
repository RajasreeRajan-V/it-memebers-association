<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RegistrationApprovedMail;
use Illuminate\Support\Facades\Hash;

class RegistrationApprovalController extends Controller
{
     public function index(Request $request)
    {
        $query = User::where('verification_status', 'pending')
            ->where('role', '!=', 'admin')
            ->with([
                'studentRegistration',
                'employeeRegistration',
                'employerRegistration',
                'freelancerRegistration',
                'investorRegistration',
                'mentorRegistration',
            ]);

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.registration_approval', compact('users'));
    }
    
    public function approve($id)
    {
        $user = User::findOrFail($id);

        // Generate a secure random plaintext password
        $plainPassword = Str::password(12); // requires Laravel 9+; see note below if unavailable

        $user->update([
            'verification_status' => 'approved',
            'status'               => 'active',
            'password'             => Hash::make($plainPassword),
        ]);

        // Send the credentials email
        try {
            Mail::to($user->email)->send(new RegistrationApprovedMail($user, $plainPassword));
        } catch (\Exception $e) {
            Log::error("Failed to send approval email to {$user->email}: " . $e->getMessage());

            return back()->with(
                'error',
                "{$user->name} was approved, but the notification email failed to send. Please resend manually."
            );
        }

        return back()->with('success', "{$user->name}'s registration has been approved and credentials have been emailed.");
    }

    /**
     * Reject a pending registration.
     */
    public function reject(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'verification_status' => 'rejected',
        ]);

        return back()->with('success', "{$user->name}'s registration has been rejected.");
    }

    public function approveAllInvestors()
{
    $investors = User::where('role', 'investor')
        ->where('verification_status', 'pending')
        ->get();

    if ($investors->isEmpty()) {
        return back()->with('error', 'No pending investors found.');
    }

    $approvedCount = 0;

    foreach ($investors as $user) {

        $plainPassword = Str::password(12);

        $user->update([
            'verification_status' => 'approved',
            'status' => 'active',
            'password' => Hash::make($plainPassword),
        ]);

        try {
            Mail::to($user->email)
                ->send(new RegistrationApprovedMail($user, $plainPassword));

            $approvedCount++;

        } catch (\Exception $e) {

            Log::error(
                "Investor email failed ({$user->email}): ".$e->getMessage()
            );
        }
    }

    return back()->with(
        'success',
        "{$approvedCount} investor(s) approved successfully and login credentials have been emailed."
    );
}
}
