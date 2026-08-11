<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LegalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'employee_id',
        'lawyer_id',
        'category',
        'issue_title',
        'description',
        'priority',
        'status',
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (LegalRequest $legalRequest) {
            if (empty($legalRequest->request_number)) {
                $legalRequest->request_number = 'LR-' . now()->format('Y') . '-' . str_pad(
                    (string) (static::whereYear('created_at', now()->year)->count() + 1),
                    3,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });
    }

    // Relationships

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

  public function assignedAdmin()
{
    return $this->belongsTo(\App\Models\Admin::class, 'assigned_admin_id');
}

    public function timelines()
    {
        return $this->hasMany(LegalRequestTimeline::class)->orderBy('sort_order');
    }

    public function documents()
    {
        return $this->hasMany(LegalRequestDocument::class);
    }

    public function messages()
    {
        return $this->hasMany(LegalRequestMessage::class)->orderBy('created_at');
    }

    // Accessors / helpers

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'submitted'     => 'Submitted',
            'under_review'  => 'Under Review',
            'assigned'      => 'Assigned',
            'in_progress'   => 'In Progress',
            'resolved'      => 'Resolved',
            'closed'        => 'Closed',
            default         => Str::title(str_replace('_', ' ', $this->status)),
        };
    }

    public function getPriorityLabelAttribute(): string
    {
        return Str::title($this->priority);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'submitted'     => 'gray',
            'under_review'  => 'orange',
            'assigned'      => 'blue',
            'in_progress'   => 'blue',
            'resolved'      => 'green',
            'closed'        => 'gray',
            default         => 'gray',
        };
    }

    public function getPriorityColorAttribute(): string
    {
        return match ($this->priority) {
            'high'   => 'red',
            'medium' => 'orange',
            'low'    => 'green',
            default  => 'gray',
        };
    }
}
