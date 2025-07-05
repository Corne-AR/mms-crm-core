<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use App\Models\Dealer;
use App\Models\Customer;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;

class CreateQuote extends CreateRecord
{
    protected static string $resource = QuoteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = 'Draft';
        $data['is_pdf_generated'] = false;

        // Default quote number logic (could be improved for concurrency)
        $latestQuote = \App\Models\Quote::orderBy('id', 'desc')->first();
        $nextId = $latestQuote ? $latestQuote->id + 1 : 1;
        $data['quote_number'] = 'Q-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        return $data;
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make()
                ->schema([
                    Select::make('dealer_id')
                        ->label('Dealer')
                        ->options(Dealer::pluck('dealer_name', 'id')->toArray())
                        ->required(),

                    Select::make('customer_id')
                        ->label('Customer')
                        ->options(Customer::pluck('company_name', 'id')->toArray())
                        ->required(),

                    DatePicker::make('quote_date')
                        ->label('Quote Date')
                        ->required()
                        ->default(now()),

                    Textarea::make('terms')
                        ->label('Terms')
                        ->default(json_encode(['Standard terms apply.']))
                        ->rows(2),

                    Toggle::make('is_pdf_generated')
                        ->label('PDF Generated')
                        ->default(false)
                        ->hidden(),

                    Hidden::make('status')->default('Draft'),
                ])
        ];
    }
}
