<?php

namespace App\Mail;

use Faker\Provider\ar_EG\Address as FakeAdress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Ramsey\Uuid\Type\Decimal;

class PaymentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;//variavel que o objeto cehckout session do stripe vai ficar
    public $order;//objeto onde as infromaçoes da order so nosso banco de dados vai ficar

    /**
     * Create a new message instance.
     */
    public function __construct($session_payment_obj, $db_order_info){
        $this->payment = $session_payment_obj;
        $this->order = $db_order_info;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email/mail-payment',
            with: [
                "image_checked" => asset('img/checked.png'),
                "image_github" => asset('img/github.png'),
                "name" => auth()->user()->user_name,
                "price" => number_format($this->payment->amount_total / 100, 2,',','.'),
                "date" => date('d/m/Y H:i:s', strtotime($this->order->created_at)),
                "payment_method" => $this->payment->payment_method_types[0]
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
