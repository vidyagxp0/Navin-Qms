<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\PasswordLog;
use Carbon\Carbon;

class PasswordReset extends Command
{
    protected $signature = 'users:update_inactive';
    protected $description = 'Update inactive users';

    public function handle()
    {
        $ninetyDaysAgo = Carbon::now()->subDays(90);

        $inactiveUserIds = PasswordLog::select('user_id')
        ->selectRaw('MAX(created_at) as last_password_change_date')
        ->groupBy('user_id')
        ->havingRaw('MAX(created_at) < ?', [$ninetyDaysAgo])
        ->pluck('user_id');
        
        User::whereIn('id', $inactiveUserIds)
            ->update(['f_login' => 0]);

        // Output a message
        $this->info('Inactive users updated successfully.');
    }
}
