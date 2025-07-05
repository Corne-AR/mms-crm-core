<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuoteResource\Pages;
use App\Models\Quote;
use App\Models\Dealer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;


class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $navigationLabel = 'Quotes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            
			Select::make('dealer_id')
				->label('Dealer')
				->searchable()
				->options(function () {
					$user = auth()->user();

					return match ($user->role) {
						// Admins see *all* dealers
						'admin'      => Dealer::pluck('dealer_name', 'id')->toArray(),

						// Key dealers see only *their* sub-dealers
						'key_dealer' => Dealer::where('parent_dealer_id', $user->dealer_id)
											  ->pluck('dealer_name', 'id')
											  ->toArray(),

						// Sub-dealers get no dropdown (we’ll hide it below)
						default      => [],
					};
				})
				// Hide entirely for sub-dealers (we’ll assign them via a Hidden field or default)
				->hidden(fn () => auth()->user()->role === 'sub_dealer')
				->required(),
				
				// Sub-Dealers never see the dropdown and have their dealer_id set behind the scenes.
				Hidden::make('dealer_id')
					->default(fn () => auth()->user()->dealer_id)
					->visible(fn () => auth()->user()->role === 'sub_dealer'),

            Select::make('customer_id')
                ->relationship('customer', 'company_name')
                ->required(),

            TextInput::make('quote_number')->required(),

            DatePicker::make('quote_date')->required(),

            Select::make('status')
                ->options([
                    'Draft' => 'Draft',
                    'Sent' => 'Sent',
                    'Accepted' => 'Accepted',
                    'Declined' => 'Declined',
                ])
                ->required(),

            Forms\Components\Textarea::make('terms')
                ->rows(3),

            TextInput::make('subtotal')->numeric()->required(),

            TextInput::make('vat_amount')->numeric()->required(),

            TextInput::make('total_amount')->numeric()->required(),

            TextInput::make('currency')->default('ZAR'),

            Toggle::make('is_pdf_generated'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('quote_number')->searchable(),
            Tables\Columns\TextColumn::make('dealer.dealer_name')->label('Dealer')->sortable(),
            Tables\Columns\TextColumn::make('customer.company_name')->label('Customer')->sortable(),
            Tables\Columns\TextColumn::make('total_amount')->sortable(),
            Tables\Columns\TextColumn::make('currency'),
            Tables\Columns\TextColumn::make('status')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

	public static function getPages(): array
	{
		return [
			'index'  => Pages\ListQuotes::route('/'),
			'create' => Pages\CreateQuote::route('/create'),
			'edit'   => Pages\EditQuote::route('/{record}/edit'),
		];
	}

}
