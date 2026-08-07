<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingMaterial;
use Illuminate\Http\Request;

class TrainingMaterialManagementController extends Controller
{
    public function index(Request $request)
    {
        $materials = TrainingMaterial::with('mentor')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        return view('admin.training-materials.index', compact('materials'));
    }

    public function approve(TrainingMaterial $material)
    {
        $material->update(['status' => 'approved', 'admin_remarks' => null]);

        return back()->with('success', 'Material approved.');
    }

    public function reject(Request $request, TrainingMaterial $material)
    {
        $data = $request->validate([
            'admin_remarks' => ['required', 'string'],
        ]);

        $material->update(['status' => 'rejected', 'admin_remarks' => $data['admin_remarks']]);

        return back()->with('success', 'Material rejected.');
    }

    public function publish(TrainingMaterial $material)
    {
        abort_unless($material->status === 'approved', 422, 'Only approved material can be published.');

        $material->update(['status' => 'published']);

        return back()->with('success', 'Material published.');
    }
}
