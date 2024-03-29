<?php
namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class NewUserVerification extends Mailable
{
    use Queueable, SerializesModels;
    private $new_user;
    public function __construct(User $new_user)
    {
        $this->new_user = $new_user;
    }
    public function build()
    {
        return $this
            ->subject('Ein neuer Nutzer hat sich registriert')
            ->markdown('emails.admin.userverification', ['user' => $this->new_user]);
    }
}
