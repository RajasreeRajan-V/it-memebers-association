<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'startup_profile_id',
        'title',
        'internship_type',
        'work_mode',
        'duration',
        'stipend',
        'qualification',
        'skills',
        'country',
        'state',
        'district',
        'city',
        'description',
        'start_date',
        'end_date',
        'positions',
        'status',
    ];

    protected $casts = [
        'skills' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function startupProfile()
    {
        return $this->belongsTo(
            StartupProfile::class,
            'startup_profile_id'
        );
    }

    public function applications()
    {
        return $this->hasMany(InternshipApplication::class);
    }

    public function selectedApplications()
    {
        return $this->applications()
            ->where(
                'status',
                InternshipApplication::STATUS_SELECTED
            );
    }



      public function modules()
    {
        return $this->hasMany(InternshipModule::class)->orderBy('sort_order');
    }
 
    /**
     * Total number of tasks across every module of this internship.
     */
    public function totalTasksCount(): int
    {
        return InternshipTask::whereIn(
            'module_id',
            $this->modules()->pluck('id')
        )->count();
    }
 /**
 * Download internship certificate as PDF.
 */
public function downloadCertificate($application)
{
    $application = \App\Models\InternshipApplication::with([
        'student',
        'user',
        'internship',
        'certificate',
    ])->findOrFail($application);

    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    | Make sure the certificate belongs to the logged-in student.
    |--------------------------------------------------------------------------
    */

    if (
        auth()->check() &&
        (int) $application->student_id !== (int) auth()->id()
    ) {
        abort(403, 'You are not authorized to download this certificate.');
    }

    /*
    |--------------------------------------------------------------------------
    | Completed Check
    |--------------------------------------------------------------------------
    */

    if ($application->status !== 'completed') {
        abort(403, 'This internship has not been completed.');
    }

    /*
    |--------------------------------------------------------------------------
    | Generate PDF
    |--------------------------------------------------------------------------
    */

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'students.internships.certificate-pdf',
        compact('application')
    );

    /*
    |--------------------------------------------------------------------------
    | Landscape A4
    |--------------------------------------------------------------------------
    */

    $pdf->setPaper('a4', 'landscape');

    /*
    |--------------------------------------------------------------------------
    | File Name
    |--------------------------------------------------------------------------
    */

    $studentName = $application->student?->name
        ?? $application->user?->name
        ?? 'Student';

    $fileName = 'Internship-Certificate-' .
        preg_replace('/[^A-Za-z0-9\-]/', '-', $studentName) .
        '.pdf';

    return $pdf->download($fileName);
}
    /**
     * How many of this internship's tasks a given student has completed.
     */
    public function completedTasksCountFor(int $studentId): int
    {
        return InternshipTaskSubmission::whereIn(
                'task_id',
                InternshipTask::whereIn(
                    'module_id',
                    $this->modules()->pluck('id')
                )->pluck('id')
            )
            ->where('student_id', $studentId)
            ->where('status', InternshipTaskSubmission::STATUS_COMPLETED)
            ->count();
    }

}