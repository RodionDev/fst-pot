<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class TestEmailStandard extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct()
    {
    }
    public function build($subject = "📺 Testversand")
    {
        $this->subject($subject)->markdown('emails.test.standard');
    }
}
