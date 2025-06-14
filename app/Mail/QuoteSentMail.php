<?php

namespace App\Mail;

use App\Models\Quote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class QuoteSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.quote', ['quote' => $this->quote]);
        $filename = 'quote_' . $this->quote->quote_number . '.pdf';

        return $this->subject('Your Quote from ' . $this->quote->subdealer->company_name)
                    ->markdown('emails.quotes.sent')
                    ->attachData($pdf->output(), $filename);
    }
}
