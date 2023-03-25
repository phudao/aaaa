<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Giao ca CNTT-QLBMB')
                    ->view('emails.user_email')
                    ->attach(public_path('bienban_giaoca.pdf'), [
                        'as' => 'bien_ban_giao_ca.pdf',
                        'mime' => 'application/pdf',
                ]);
    }
}
