<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var DteRequest
     */
    public $dteRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dteRequest)
    {
        $this->dteRequest = $dteRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->text('mails.dte_request_plain');
    }
}
