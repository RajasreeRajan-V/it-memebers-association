<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_material_id',
        'student_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function material()
    {
        return $this->belongsTo(TrainingMaterial::class, 'training_material_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}