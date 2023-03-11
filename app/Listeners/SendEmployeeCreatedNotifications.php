<?php

namespace App\Listeners;

use App\Events\EmployeeCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use App\Notifications\NewEmployee;


class SendEmployeeCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmployeeCreated $event): void
    {
        foreach( User::where('is_admin', 1)->cursor() as $user){
            $user->notify( new NewEmployee($event->employee) );
        }
    }
}
