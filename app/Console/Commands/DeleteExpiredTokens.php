<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class DeleteExpiredTokens extends Command
{
    protected $signature = 'tokens:delete-expired';
    protected $description = 'Xoá tất cả token đã hết hạn';
    public function handle()
    {
        $count = PersonalAccessToken::whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->delete();
        $this->info("Đã xoá {$count} token hết hạn.");
    }
}
