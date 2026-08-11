<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\TrainingMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainingMaterialController extends Controller
{
    public function index(Request $request)
    {
        $mentorId = Auth::id();

        $base = TrainingMaterial::where('mentor_id', $mentorId);

        // ---- Top-line stat cards ----
        $stats = [
            'total'     => (clone $base)->count(),
            'published' => (clone $base)->where('status', 'published')->count(),
            'pending'   => (clone $base)->where('status', 'pending')->count(),
            'downloads' => (clone $base)->sum('downloads_count'),
            'views'     => (clone $base)->sum('views_count'),
            'avg_rating'=> (clone $base)->where('rating_count', '>', 0)->avg('rating_avg'),
        ];

        // ---- Tab filter (All / Published / Recommended / Rejected) ----
        $tab = $request->query('tab', 'all');
        $query = clone $base;

        match ($tab) {
            'published'   => $query->where('status', 'published'),
            'rejected'    => $query->where('status', 'rejected'),
            'recommended' => $query->where('rating_avg', '>=', 4.5),
            default       => null, // 'all' — no extra filter
        };

        // ---- Search ----
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // ---- Sort ----
        match ($request->query('sort', 'newest')) {
            'oldest'       => $query->oldest(),
            'most_viewed'  => $query->orderByDesc('views_count'),
            'most_downloaded' => $query->orderByDesc('downloads_count'),
            default        => $query->latest(),
        };

        $materials = $query->paginate(3)->withQueryString();

        // ---- Sidebar: top categories ----
        $topCategories = (clone $base)
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // ---- Sidebar: most downloaded ----
        $mostDownloaded = (clone $base)
            ->orderByDesc('downloads_count')
            ->limit(5)
            ->get(['id', 'title', 'downloads_count']);

        return view('mentor.training-materials.index', compact(
            'materials', 'stats', 'tab', 'topCategories', 'mostDownloaded'
        ));
    }

    public function create()
    {
        return view('mentor.training-materials.create');
    }

    // Upload material and submit for admin approval
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:pdf,video,ppt'],
            'file' => ['required', 'file', 'mimes:pdf,ppt,pptx,mp4,mov,avi', 'max:51200'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $filePath = $request->file('file')->store('training-materials', 'public');

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('training-materials/covers', 'public');
        }

        TrainingMaterial::create([
            'mentor_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'],
            'type' => $data['type'],
            'file_path' => $filePath,
            'cover_image' => $coverPath,
            'status' => 'pending', // waits for admin approval before it can be published
        ]);

        return redirect()->route('mentor.training-materials.index')
            ->with('success', 'Material uploaded and submitted for admin approval.');
    }

    public function destroy(TrainingMaterial $trainingMaterial)
    {
        abort_unless($trainingMaterial->mentor_id === auth()->id(), 403);

        if ($trainingMaterial->file_path) {
            Storage::disk('public')->delete($trainingMaterial->file_path);
        }
        if ($trainingMaterial->cover_image) {
            Storage::disk('public')->delete($trainingMaterial->cover_image);
        }

        $trainingMaterial->delete();

        return redirect()
            ->route('mentor.training-materials.index')
            ->with('success', 'Material deleted successfully.');
    }

    public function download(TrainingMaterial $trainingMaterial)
    {
        abort_unless($trainingMaterial->mentor_id === auth()->id(), 403);
        abort_unless($trainingMaterial->file_path, 404);

        $trainingMaterial->increment('downloads_count');

        return Storage::disk('public')->download(
            $trainingMaterial->file_path,
            $trainingMaterial->title
        );
    }

    public function incrementView(TrainingMaterial $trainingMaterial)
    {
        abort_unless($trainingMaterial->mentor_id === Auth::id(), 403);
        $trainingMaterial->increment('views_count');
        return response()->json(['views' => $trainingMaterial->views_count]);
    }

    public function rate(Request $request, TrainingMaterial $trainingMaterial)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $newCount = $trainingMaterial->rating_count + 1;
        $newAvg   = (($trainingMaterial->rating_avg * $trainingMaterial->rating_count) + $data['rating']) / $newCount;

        $trainingMaterial->update([
            'rating_count' => $newCount,
            'rating_avg'   => round($newAvg, 2),
        ]);

        return response()->json([
            'rating_avg'   => round($trainingMaterial->rating_avg, 1),
            'rating_count' => $trainingMaterial->rating_count,
            'user_rating'  => $data['rating'],
        ]);
    }
}