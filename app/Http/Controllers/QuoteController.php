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
				$qty = (int) $request->qty[$index];

				// Look up the product in DB
				$product = \App\Models\Product::where('name', $productName)->first();

				if (!$product) {
					throw new \Exception("Product '{$productName}' not found.");
				}

				$unitPrice = $product->price ?? 0;
				$lineTotal = $qty * $unitPrice;
				$subtotal += $lineTotal;

				QuoteItem::create([
					'quote_id' => $quote->id,
					'product_id' => $product->id,
					'qty' => $qty,
					'unit_price' => $unitPrice,
					'line_discount' => 0,
				]);
			}
			
            $vat = $subtotal * 0.15; //Vat rate 0.15 should not be hard coded, 	remeber to add the VAT variable in the admin settings
			
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
