<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DealerResource\Pages;
use App\Filament\Resources\DealerResource\RelationManagers;
use App\Models\Dealer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DealerResource extends Resource
{
    protected static ?string $model = Dealer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
	
	 // Place under the CRM navigation group
	protected static ?string $navigationGroup = 'CRM';

    public static function form(Form $form): Form
    {
        return $form->schema([
                TextInput::make('dealer_name')
                    ->required()
                    ->maxLength(255),
					
				Select::make('type')
                ->label('Type')
                ->options([
                    'admin'      => 'Admin',
                    'key_dealer' => 'Key Dealer',
                    'sub_dealer' => 'Sub Dealer',
                ])
                ->searchable()
                ->required(),
				
                TextInput::make('contact_person')
                    ->maxLength(255)
                    ->default(null),
					
                TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
					
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(50)
                    ->default(null),
					
                Textarea::make('address')
                    ->rows(3),
					
                Textarea::make('bank_details')
                    ->rows(3),
					
				FileUpload::make('logo')
					->disk('public')
					->directory('logos')
					->visibility('public')
					->image()
					->imagePreviewHeight('150')
					->columnSpanFull()
					->rules(['nullable', 'image', 'max:1024'])
					->label('Logo')
					->required(false),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dealer_name')
                    ->label('Dealer')
                    ->sortable()
                    ->searchable(),
					
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
					->searchable(),
					
                Tables\Columns\TextColumn::make('contact_person')
                    ->searchable(),
					
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
					
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
					
                Tables\Columns\TextColumn::make('logo_path')
                    ->searchable(),
					
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
					
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDealers::route('/'),
            'create' => Pages\CreateDealer::route('/create'),
            'edit' => Pages\EditDealer::route('/{record}/edit'),
        ];
    }
}
