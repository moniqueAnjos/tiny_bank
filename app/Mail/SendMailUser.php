<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;
    
    private $transactionAmount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $transactionAmount)
    {
        $this->transactionAmount = $transactionAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('to@email.com')
            ->view('emails.transactionNotification')
            ->subject('Tiny Bank')
            ->with([
                'transactionAmount' => $this->transactionAmount
            ]);
    }
}
