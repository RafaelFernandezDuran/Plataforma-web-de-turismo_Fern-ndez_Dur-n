<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class RecordUserLogin
{
    public function handle(Login $event): void
    {
        if (! $event->user) {
            return;
        }

        /** @var \App\Models\User $user */
        $user = $event->user;

        $user->update([
            'last_activity' => now(),
        ]);
    }
}
