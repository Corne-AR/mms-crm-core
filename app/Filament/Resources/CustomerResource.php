<?php

namespace App\Filament\Resources;

use App\Models\Customer;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Support\Facades\Auth;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?string $navigationGroup = 'CRM';

public static function form(Forms\Form $form): Forms\Form
{
    return $form->schema([
        TextInput::make('company_name')->required(),
		Textarea::make('address')
			->label('Address')
			->rows(3)
			->columnSpanFull()
			->placeholder('Enter full address')
			->required(false),
        TextInput::make('contact_full_name')->required(),
        TextInput::make('email')->email()->required(),
        TextInput::make('phone')->required(),
        TextInput::make('vendor_nr')->label('Vendor Number')->nullable(),
        TextInput::make('vat_nr')->label('VAT Number')->nullable(),
        Select::make('category')
            ->options([
                'Irigation' => 'Irigation',
                'Consultant' => 'Consultant',
                'Contractor' => 'Contractor',
                'Government' => 'Government',
                'Mine' => 'Mine',
                'Quantity Surveying' => 'Quantity Surveying',
                'Survey' => 'Survey',
                'Town Planning' => 'Town Planning',
                'Golf Course' => 'Golf Course',
                'Municipality' => 'Municipality',
                'Landscaping' => 'Landscaping',
                'Architects' => 'Architects',
                'Supplier' => 'Supplier',
                'Farm' => 'Farm',
                'Reseller' => 'Reseller',
                'Other' => 'Other',
            ])
            ->required(),
        Select::make('language')
            ->options(['Afrikaans' => 'Afrikaans', 'English' => 'English', 'Other' => 'Other'])
            ->default('English')
            ->required(),
        Select::make('type')
            ->options(['Local' => 'Local', 'International' => 'International', 'Other' => 'Other'])
            ->default('Local')
            ->required(),
        Select::make('currency')
            ->options(['ZAR' => 'ZAR', 'USD' => 'USD', 'GBP' => 'GBP', 'EUR' => 'EUR', 'Other' => 'Other'])
            ->default('ZAR')
            ->required(),
        Textarea::make('notes')
			->label('Notes')
			->rows(3)
			->nullable()
			->columnSpanFull(),
		Hidden::make('created_by')
			->default(fn () => Auth::id())
			->required()
			->dehydrated()
			->hidden(),
    ]);
}

public static function table(Tables\Table $table): Tables\Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('company_name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('contact_full_name')
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->searchable(),

            Tables\Columns\TextColumn::make('phone')
                ->searchable(),

            Tables\Columns\TextColumn::make('vendor_nr')
                ->label('Vendor #')
                ->searchable(),

            Tables\Columns\TextColumn::make('category'),

            Tables\Columns\TextColumn::make('language'),

            Tables\Columns\TextColumn::make('currency'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category')
                ->options([
                    'Irigation' => 'Irigation',
                    'Consultant' => 'Consultant',
                    'Contractor' => 'Contractor',
                    'Government' => 'Government',
                    'Mine' => 'Mine',
                    'Quantity Surveying' => 'Quantity Surveying',
                    'Survey' => 'Survey',
                    'Town Planning' => 'Town Planning',
                    'Golf Course' => 'Golf Course',
                    'Municipality' => 'Municipality',
                    'Landscaping' => 'Landscaping',
                    'Architects' => 'Architects',
                    'Supplier' => 'Supplier',
                    'Farm' => 'Farm',
                    'Reseller' => 'Reseller',
                    'Other' => 'Other',
                ])
                ->label('Category'),

            Tables\Filters\SelectFilter::make('language')
                ->options([
                    'Afrikaans' => 'Afrikaans',
                    'English' => 'English',
                    'Other' => 'Other',
                ])
                ->label('Language'),

            Tables\Filters\SelectFilter::make('currency')
                ->options([
                    'ZAR' => 'ZAR',
                    'USD' => 'USD',
                    'GBP' => 'GBP',
                    'EUR' => 'EUR',
                    'Other' => 'Other',
                ])
                ->label('Currency'),

            Tables\Filters\Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('from')->label('From'),
                    Forms\Components\DatePicker::make('until')->label('Until'),
                ])
                ->query(function ($query, array $data) {
                    return $query
                        ->when($data['from'], fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                        ->when($data['until'], fn ($query, $date) => $query->whereDate('created_at', '<=', $date));
                }),
        ])
        ->defaultSort('created_at', 'desc');
}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
