<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployerPortalNotification extends Model
{
    use HasFactory;

    protected $table = 'employer_portal_notifications';

    protected $fillable = [
        'employer_id',
        'type',
        'title',
        'message',
        'url',
        'is_read',
        'reference_id',
        'reference_type',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Employer
    |--------------------------------------------------------------------------
    */

    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Mark as read
    |--------------------------------------------------------------------------
    */

    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Mark as unread
    |--------------------------------------------------------------------------
    */

    public function markAsUnread(): void
    {
        if ($this->is_read) {
            $this->update([
                'is_read' => false,
            ]);
        }
    }
}