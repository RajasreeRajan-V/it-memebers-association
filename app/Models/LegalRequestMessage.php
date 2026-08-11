<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LegalRequestMessage extends Model
{
    protected $fillable = [
        'legal_request_id',
    'sender_id',
    'sender_type',   // <-- this line must be here
    'message',
    'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function legalRequest()
    {
        return $this->belongsTo(LegalRequest::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function attachments()
    {
        return $this->hasMany(LegalRequestMessageAttachment::class);
    }
}
