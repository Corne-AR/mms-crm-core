@component('mail::message')
# {{ $invoice->invoice_type }} {{ $invoice->invoice_number }}

Dear {{ $invoice->customer->company_name }},

Please find attached your invoice.

Thank you for your business!

Kind regards,  
{{ $invoice->subdealer->company_name }}

@endcomponent
