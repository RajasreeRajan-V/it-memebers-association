<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MentorRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MentorshipRequest;
class MentorController extends Controller
{
    /**
     * Show the "Find Mentors" page with search/filter support.
     */
    public function index(Request $request)
    {
        $query = MentorRegistration::query()->with('user');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('expertise', 'like', "%{$search}%")
                  ->orWhere('designation', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('expertise')) {
            $query->where('expertise', 'like', '%' . $request->input('expertise') . '%');
        }

        if ($request->filled('experience')) {
            [$min, $max] = $this->parseExperienceRange($request->input('experience'));
            $query->when($min !== null, fn ($q) => $q->where('years_of_experience', '>=', $min));
            $query->when($max !== null, fn ($q) => $q->where('years_of_experience', '<=', $max));
        }

        $registrations = $query->latest()->paginate(12)->withQueryString();

        $mentors = $registrations->getCollection()->map(function (MentorRegistration $registration) {
            return [
                'id' => $registration->id,
                'name' => $registration->user->name ?? 'Mentor',
                'designation' => $registration->designation,
                'company' => $registration->company,
                'company_icon' => 'building',
                'skills' => is_array($registration->expertise)
                    ? $registration->expertise
                    : array_filter(explode(',', (string) $registration->expertise)),
                'years_experience' => $registration->years_of_experience,
                'mentees_count' => $registration->mentees_count ?? 0,
                'availability' => $registration->availability,
                'status' => $registration->status ?? 'online',
                'rating' => $registration->rating ?? '4.8',
                'photo' => $registration->profile_photo
                    ? asset('storage/' . $registration->profile_photo)
                    : null,
            ];
        });

        return view('students.find-mentors', [
            'mentors' => $mentors,
            'pagination' => $registrations,
            'pendingCount' => Auth::user()?->mentorshipRequests()->where('status', 'pending')->count() ?? 0,
            'acceptedCount' => Auth::user()?->mentorshipRequests()->where('status', 'accepted')->count() ?? 0,
            'upcomingSessionsCount' => Auth::user()?->sessions()->where('status', 'upcoming')->count() ?? 0,
            'completedSessionsCount' => Auth::user()?->sessions()->where('status', 'completed')->count() ?? 0,
        ]);
    }

    /**
     * View a single mentor's public profile.
     */
    public function show(MentorRegistration $mentor)
    {
        return view('students.mentor-profile', compact('mentor'));
    }

    /**
     * Show the mentorship request form for a mentor.
     */
    public function requestForm(MentorRegistration $mentor)
    {
        return view('students.mentor-request', compact('mentor'));
    }

    /**
     * Store a new mentorship request.
     */
public function storeRequest(Request $request, MentorRegistration $mentor)
{
    $data = $request->validate([
        'preferred_date' => ['required', 'date', 'after_or_equal:today'],
        'preferred_time' => ['required'],
        'goal' => ['required', 'string', 'max:1000'],
    ]);

  MentorshipRequest::create([
    'mentor_id'      => $mentor->user_id,
    'mentee_id'      => auth()->id(),
    'preferred_date' => $data['preferred_date'],
    'preferred_time' => $data['preferred_time'],
    'goal'           => $data['goal'],
    'status'         => 'pending',
]);

    return redirect()
        ->route('student.mentors.index')
        ->with('success', 'Mentorship request sent successfully.');
}

    private function parseExperienceRange(string $range): array
    {
        return match ($range) {
            '1-3' => [1, 3],
            '4-7' => [4, 7],
            '8+' => [8, null],
            default => [null, null],
        };
    }
}
