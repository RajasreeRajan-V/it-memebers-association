<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalRequestMessageAttachment extends Model
{
    protected $fillable = [
        'legal_request_message_id',
        'file_name',
        'file_path',
        'file_type',
    ];

    public function message()
    {
        return $this->belongsTo(LegalRequestMessage::class, 'legal_request_message_id');
    }
}
