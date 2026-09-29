<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingOutcome extends Model
{
    protected $fillable = ['training_id', 'outcome', 'order'];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
