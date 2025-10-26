<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class RecordUserLogout
{
    public function handle(Logout $event): void
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
