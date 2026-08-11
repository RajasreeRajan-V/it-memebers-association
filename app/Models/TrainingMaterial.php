<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id', 'title', 'description', 'category', 'type', 'file_path',
        'cover_image',
        'status', 'admin_remarks',
        'views_count', 'downloads_count', 'rating_count', 'rating_avg',
    ];

    protected $casts = [
        'views_count' => 'integer',
        'downloads_count' => 'integer',
        'rating_count' => 'integer',
        'rating_avg' => 'float',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}