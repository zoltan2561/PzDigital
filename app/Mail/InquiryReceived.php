<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Inquiry $inquiry) {}

    public function envelope(): Envelope
    {
        $isDemo = str_starts_with($this->inquiry->interest_type, 'demo_');

        return new Envelope(
            replyTo: [new Address($this->inquiry->email, $this->inquiry->name)],
            subject: 'Új '.config('pzdigital.brand.name').' '.($isDemo ? 'demóigénylés' : 'megkeresés').': '.($isDemo ? $this->inquiry->product_slug : $this->inquiry->interest_type),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.inquiry-received');
    }
}
