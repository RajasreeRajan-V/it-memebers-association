<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerService extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'Web Development',
        'UI/UX and Graphic Design',
        'Software and Mobile Applications',
        'Data and Digital Services',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'description',
        'skills',
        'price',
        'delivery_days',
        'portfolio_url',
        'portfolio_image',
        'revision_policy',
        'status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function inquiries()
{
    return $this->hasMany(FreelancerServiceInquiry::class, 'service_id');
}

    public function scopeApproved($q)
    {
        return $q->where('status', 'approved');
    }
    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }

    public function skillList(): array
    {
        return array_filter(array_map('trim', explode(',', $this->skills)));
    }
}
