<?php

namespace App\Helpers;

use App\Models\EmployerPortalNotification;

class EmployerPortalNotificationHelper
{
    public static function send(
        int $employerId,
        string $type,
        string $title,
        string $message,
        ?string $url = null,
        ?int $referenceId = null,
        ?string $referenceType = null
    ): EmployerPortalNotification {
        return EmployerPortalNotification::create([
            'employer_id'    => $employerId,
            'type'           => $type,
            'title'          => $title,
            'message'        => $message,
            'url'             => $url ?? '',
            'is_read'        => false,
            'reference_id'   => $referenceId,
            'reference_type' => $referenceType ?? '',
        ]);
    }
}