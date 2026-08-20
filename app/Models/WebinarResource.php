<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WebinarResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'webinar_id',
        'type',
        'title',
        'url',
        'file_path',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    /**
     * Resolve the link to give the student — either the external URL
     * or a storage URL for an uploaded file.
     */
    public function getLinkAttribute(): ?string
    {
        if ($this->url) {
            return $this->url;
        }

        if ($this->file_path) {
            return Storage::url($this->file_path);
        }

        return null;
    }
}