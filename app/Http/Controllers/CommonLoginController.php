<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommonLoginController extends Controller
{
    public function login()
{
    return redirect()->route('home')->with('open_login_modal', true);
}
    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    $user = User::where('email', $credentials['email'])->first();

    // Only investors need to be "approved" before they can log in
    if ($user && $user->role === 'investor' && $user->verification_status !== 'approved') {
        throw ValidationException::withMessages([
            'email' => 'Your registration is still pending approval. Please wait for admin confirmation.',
        ])->errorBag('login');
    }

    if ($user && $user->status !== 'active') {
        throw ValidationException::withMessages([
            'email' => 'Your account is inactive. Please contact support.',
        ])->errorBag('login');
    }

    if (! Auth::attempt($credentials, $request->boolean('remember'))) {
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ])->errorBag('login');
    }

$request->session()->regenerate();

return redirect()->route('dashboard');
}
      protected function redirectToDashboard(User $user)
    {
        return match ($user->role) {
            'student'     => redirect()->route('student.dashboard'),
            'employee'    => redirect()->route('employee.dashboard'),
            'employer'    => redirect()->route('employer.dashboard'),
            'freelancer'  => redirect()->route('freelancer.dashboard'),
            'investor'    => redirect()->route('investor.dashboard'),
            'mentor'      => redirect()->route('mentor.dashboard'),
            'admin'       => redirect()->route('admin.dashboard'),
            default       => redirect()->route('login')->withErrors(['email' => 'No dashboard found for your role.']),
        };
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('membership');
    }

}
