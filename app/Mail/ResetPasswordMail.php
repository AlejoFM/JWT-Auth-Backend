<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $admin
     * @param  string  $token
     */
    public function __construct($admin, $token)
    {
        $this->admin = $admin;
        $this->token = $token;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Restablecimiento de Contraseña')
            ->view('test-email');
    }
}
