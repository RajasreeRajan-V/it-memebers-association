<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LegalRequestTimeline extends Model
{
    protected $fillable = [
        'legal_request_id',
        'title',
        'description',
        'status',
        'created_by',
        'sort_order',
    ];

    public function legalRequest()
    {
        return $this->belongsTo(LegalRequest::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
