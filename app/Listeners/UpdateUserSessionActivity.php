<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class UpdateUserSessionActivity
{
    public function handleLogin(Login $event): void
    {
        if (! $event->user) {
            return;
        }

        $event->user->forceFill([
            'last_activity' => now(),
        ])->saveQuietly();
    }

    public function handleLogout(Logout $event): void
    {
        if (! $event->user) {
            return;
        }

        $event->user->forceFill([
            'last_activity' => now(),
        ])->saveQuietly();
    }
}
