<?php
namespace App\Listeners;
use App\Mail\NewUserVerification;
use App\Notifications\NewUserVerified;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendNewUserVerifiedMailToAdmin
{
    public function __construct()
    {
    }
    public function handle($event)
    {
        $admin = User::admins()->first();
        if ($admin) {
            Mail::to($admin)->send(new NewUserVerification($event->user));
        }
    }
}
