<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingRequirement extends Model
{
    protected $fillable = ['training_id', 'requirement', 'order'];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }
}
