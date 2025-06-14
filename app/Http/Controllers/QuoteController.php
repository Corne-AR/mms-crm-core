<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class QuoteController extends Controller
{
    public function store(StoreQuoteRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $quote = Quote::create([
                'dealer_id' => auth()->user()->dealer_id,
                'customer_id' => $request->customer_id,
                'quote_number' => 'Q-' . now()->format('YmdHis'),
                'subtotal' => 0,
                'vat_amount' => 0,
                'total_amount' => 0,
            ]);

            $subtotal = 0;
            foreach ($request->product as $index => $productName) {
                $qty = (int)$request->qty[$index];
                $unitPrice = 100; // Placeholder: replace with real product price lookup
                $lineTotal = $qty * $unitPrice;
                $subtotal += $lineTotal;

                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'product_id' => 1, // TODO: fetch actual product ID
                    'qty' => $qty,
                    'unit_price' => $unitPrice,
                    'line_discount' => 0,
                ]);
            }

            $vat = $subtotal * 0.15;
            $quote->update([
                'subtotal' => $subtotal,
                'vat_amount' => $vat,
                'total_amount' => $subtotal + $vat,
            ]);

            DB::commit();

            return redirect()->route('quotes.index')->with('status', 'Quote created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating quote: ' . $e->getMessage());
        }
    }
}
