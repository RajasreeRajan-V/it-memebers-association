<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreelancerWorkReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'freelancer_bid_id',
        'report_date',
        'title',
        'work_description',
        'progress_percentage',
        'challenges',
        'next_steps',
        'attachment_path',
    ];

    protected function casts(): array
    {
        return [
            'report_date' => 'date',
            'progress_percentage' => 'integer',
        ];
    }

    public function freelancerBid(): BelongsTo
    {
        return $this->belongsTo(
            FreelancerBid::class,
            'freelancer_bid_id'
        );
    }
}