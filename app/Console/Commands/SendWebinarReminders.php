<?php

namespace App\Console\Commands;

use App\Mail\WebinarReminder;
use App\Models\WebinarRegistration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWebinarReminders extends Command
{
    protected $signature = 'webinars:send-reminders';

    protected $description = 'Send 24-hour and 30-minute reminder emails for upcoming approved webinar registrations';

    public function handle(): int
    {
        $now = now();
        $sent24h = 0;
        $sent30min = 0;

        $registrations = WebinarRegistration::with(['webinar', 'student'])
            ->where('status', 'approved')
            ->where(function ($q) {
                $q->whereNull('reminder_24h_sent_at')
                  ->orWhereNull('reminder_30min_sent_at');
            })
            ->whereHas('webinar', fn ($q) => $q->where('status', 'published'))
            ->get();

        foreach ($registrations as $registration) {
            $webinar = $registration->webinar;
            $at = $webinar?->scheduledAt();

            if (! $at || ! $at->isFuture()) {
                continue;
            }

            // 24-hour window: send as soon as we're within 24h of start, only once.
            if (is_null($registration->reminder_24h_sent_at) && $now->gte((clone $at)->subDay())) {
                if ($this->sendReminder($registration, '24h')) {
                    $registration->update(['reminder_24h_sent_at' => $now]);
                    $sent24h++;
                }
            }

            // 30-minute window: send as soon as we're within 30 min of start, only once.
            if (is_null($registration->reminder_30min_sent_at) && $now->gte((clone $at)->subMinutes(30))) {
                if ($this->sendReminder($registration, '30min')) {
                    $registration->update(['reminder_30min_sent_at' => $now]);
                    $sent30min++;
                }
            }
        }

        $this->info("Sent {$sent24h} 24-hour reminder(s) and {$sent30min} 30-minute reminder(s).");

        return self::SUCCESS;
    }

    private function sendReminder(WebinarRegistration $registration, string $type): bool
    {
        try {
            Mail::to($registration->student->email)->send(
                new WebinarReminder($registration->webinar, $registration, $registration->student, $type)
            );

            return true;
        } catch (\Throwable $e) {
            Log::error("Failed to send {$type} webinar reminder", [
                'registration_id' => $registration->id,
                'error'            => $e->getMessage(),
            ]);

            return false;
        }
    }
}