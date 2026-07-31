<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAlertSubscription extends Model
{
    protected $fillable = ['user_id', 'email'];
}