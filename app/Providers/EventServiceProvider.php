<?php
namespace App\Providers;
use App\Listeners\SendNewUserVerifiedMailToAdmin;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            SendNewUserVerifiedMailToAdmin::class,
        ],
    ];
    public function boot()
    {
        parent::boot();
    }
}
