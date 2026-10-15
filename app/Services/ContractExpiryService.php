<?php

namespace App\Services;

use App\Mail\ContractCancelledMail;
use App\Models\EmployeeFreelanceJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContractExpiryService
{
    public function cancelExpired(): int
    {
        $count = 0;

        EmployeeFreelanceJob::query()
            ->contractOverdue()
            ->with(['project.employer', 'employee.user'])
            ->chunkById(100, function ($applications) use (&$count) {
                foreach ($applications as $application) {

                    // Re-check under a lock so a signature arriving at the
                    // same moment is never cancelled by mistake.
                    $cancelled = DB::transaction(function () use ($application) {
                        $fresh = EmployeeFreelanceJob::lockForUpdate()->find($application->id);

                        if (!$fresh || !$fresh->isContractOverdue()) {
                            return false;
                        }

                        $fresh->cancelContract(
                            'Signed contract was not returned within '
                            . EmployeeFreelanceJob::CONTRACT_VALIDITY_DAYS . ' days.'
                        );

                        return true;
                    });

                    if (!$cancelled) {
                        continue;
                    }

                    $application->refresh();
                    $count++;

                    $this->notify($application);
                }
            });

        return $count;
    }

    private function notify(EmployeeFreelanceJob $application): void
    {
        $employerEmail = optional($application->project->employer)->email;
        $employeeEmail = optional(optional($application->employee)->user)->email;

        // A mail failure must never break the page or the cron call.
        try {
            if ($employerEmail) {
                Mail::to($employerEmail)->send(new ContractCancelledMail($application, 'employer'));
            }
            if ($employeeEmail) {
                Mail::to($employeeEmail)->send(new ContractCancelledMail($application, 'employee'));
            }
        } catch (\Throwable $e) {
            report($e);
        }
    }
}