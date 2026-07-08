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
        return view('login');
    }
     public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Block login for anyone not yet approved
        if ($user && $user->verification_status !== 'approved') {
            throw ValidationException::withMessages([
                'email' => 'Your registration is still pending approval. Please wait for admin confirmation.',
            ]);
        }

        if ($user && $user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => 'Your account is inactive. Please contact support.',
            ]);
        }

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return $this->redirectToDashboard(Auth::user());
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

        return redirect()->route('login');
    }

}
