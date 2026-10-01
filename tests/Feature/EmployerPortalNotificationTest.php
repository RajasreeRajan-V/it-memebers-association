<?php

use App\Helpers\EmployerPortalNotificationHelper;
use App\Models\EmployerPortalNotification;
use App\Models\User;

test('employer portal notifications can be created with the expected fields', function () {
    $employer = User::factory()->create();

    $notification = EmployerPortalNotificationHelper::send(
        employerId: $employer->id,
        type: 'application',
        title: 'New Applicant',
        message: 'A candidate has applied for your job.',
        url: '/employer/applicants',
        referenceId: 42,
        referenceType: 'application'
    );

    expect($notification)
        ->toBeInstanceOf(EmployerPortalNotification::class)
        ->and($notification->employer_id)->toBe($employer->id)
        ->and($notification->type)->toBe('application')
        ->and($notification->title)->toBe('New Applicant')
        ->and($notification->message)->toBe('A candidate has applied for your job.')
        ->and($notification->url)->toBe('/employer/applicants')
        ->and($notification->is_read)->toBeFalse()
        ->and($notification->reference_id)->toBe(42)
        ->and($notification->reference_type)->toBe('application');
});
