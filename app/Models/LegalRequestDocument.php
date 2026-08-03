<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LegalRequestDocument extends Model
{
    protected $fillable = [
        'legal_request_id',
        'uploaded_by',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function legalRequest()
    {
        return $this->belongsTo(LegalRequest::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = (int) $this->file_size;

        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . ' MB';
        }

        if ($bytes >= 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }

        return $bytes . ' B';
    }
}
