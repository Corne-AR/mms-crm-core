<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use App\Models\Dealer;
use App\Models\Customer;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;

class EditQuote extends EditRecord
{
    protected static string $resource = QuoteResource::class;

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
                        ->required(),

                    Textarea::make('terms')
                        ->label('Terms')
                        ->rows(2),

                    Toggle::make('is_pdf_generated')
                        ->label('PDF Generated'),

                    Hidden::make('status'),
                ])
        ];
    }
}
