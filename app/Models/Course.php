<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id', 'title', 'description', 'category', 'cover_image',
        'status', 'views_count', 'enrollments_count',
        'rating_avg', 'rating_count', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function lessons()
    {
        return $this->hasMany(CourseLesson::class)->orderBy('sort_order');
    }

    public function getLessonsCountAttribute(): int
    {
        return $this->relationLoaded('lessons')
            ? $this->lessons->count()
            : $this->lessons()->count();
    }

    public function getTotalDurationAttribute(): int
    {
        return $this->relationLoaded('lessons')
            ? $this->lessons->sum('duration_minutes')
            : $this->lessons()->sum('duration_minutes');
    }


    
}