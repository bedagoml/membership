<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmPayment extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
                $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Confirmation')->markdown('emails.confirmPayment')->attach('/invoice/'.$this->data['invoice'].'/pdf', [
                    'as' => $this->data['name'].' - Payment Confirmation.pdf',
                    'mime' => 'application/pdf',
                ]);
    }
}
