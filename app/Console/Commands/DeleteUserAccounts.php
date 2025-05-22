<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteUserAccounts extends Command
{
    protected $signature = 'delete:user-accounts';
    protected $description = 'Delete user accounts after the admission period ends';

    public function handle()
    {
        $endDate = Carbon::createFromDate(null, 6, 31); // March 31st
        $currentDate = Carbon::now();

        if ($currentDate->greaterThan($endDate)) {
            User::where('role', 'user')->each(function ($user) {
                $user->delete();
            });
            $this->info('User accounts deleted successfully.');
        } else {
            $this->info('Admission period is still ongoing.');
        }
    }
}