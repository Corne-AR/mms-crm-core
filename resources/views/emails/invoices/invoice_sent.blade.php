@component('mail::message')
# Invoice {{ $invoice->invoice_number }}

Dear {{ $invoice->customer->company_name }},

Thank you for your interest. Please find attached your invoice.

If you have any questions, feel free to contact us.

Best regards,  
{{ $invoice->subdealer->company_name }}

@endcomponent
