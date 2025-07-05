<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Product;
use App\Models\Kit;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        $productsByCategory = Product::all()->groupBy('category');
        $kits = Kit::with('items')->get();
        $currencies = ['ZAR', 'USD', 'EUR']; // Adjust if needed

        return view('quotes.create', compact('customers', 'productsByCategory', 'kits', 'currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'currency' => 'required|string|max:10',
            'item' => 'required|array',
            'qty' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $quote = Quote::create([
                'dealer_id' => auth()->user()->dealer_id,
                'customer_id' => $request->customer_id,
                'quote_number' => 'Q-' . now()->format('YmdHis'),
                'quote_date' => now(),
                'status' => 'Draft',
                'currency' => $request->currency,
                'subtotal' => 0,
                'vat_amount' => 0,
                'total_amount' => 0,
            ]);

            $subtotal = 0;

            foreach ($request->item as $index => $value) {
                $qty = (int) $request->qty[$index];
                $price = 0;
                $productId = null;

                if (str_starts_with($value, 'product-')) {
                    $productId = (int) str_replace('product-', '', $value);
                    $product = Product::find($productId);
                    $price = $product?->price ?? 0;
                } elseif (str_starts_with($value, 'kit-')) {
                    $kitId = (int) str_replace('kit-', '', $value);
                    $kit = Kit::with('items')->find($kitId);
                    $price = $kit?->total_price ?? 0;
                }

                $lineTotal = $qty * $price;
                $subtotal += $lineTotal;

                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'product_id' => $productId, // null for kits
                    'qty' => $qty,
                    'unit_price' => $price,
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

    public function show(Quote $quote)
    {
        return view('quotes.show', compact('quote'));
    }
}
