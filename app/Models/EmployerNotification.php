<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployerNotification extends Model
{
    protected $fillable = ['employer_id', 'title', 'message', 'type', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}