<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AdminConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'confirmable_type',
        'confirmable_id',
        'action',
        'requested_by',
        'status',
        'admin_id',
        'admin_notes',
        'confirmed_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    public function confirmable()
    {
        return $this->morphTo();
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    // Admin guard may use a separate model — adjust if you have an Admin model instead of User
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeAction(Builder $query, string $action): Builder
    {
        return $query->where('action', $action);
    }
}