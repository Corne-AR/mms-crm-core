@component('mail::message')
# Quote {{ $quote->quote_number }}

Dear {{ $quote->customer->company_name }},

Thank you for your interest. Please find attached your quote.

If you have any questions, feel free to contact us.

Best regards,  
{{ $quote->subdealer->company_name }}

@endcomponent
