<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class SendMailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = URL::signedRoute('verification.verify', ['id' => $this->user->id, 'hash' => sha1($this->user->email)], now());
        $pattern = '/localhost:8080/i';
        preg_replace($pattern, 'http://localhost:8081', $url);

        return $this->view('mail.send_verification')->with([
            'url' => $url,
        ]);
    }
}
