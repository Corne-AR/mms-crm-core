<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Admin';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Username')
                ->required()
				->unique(ignoreRecord: true),

            TextInput::make('email')
				->email()
				->required()
				->unique(ignoreRecord: true),


			Section::make('User Password')
				->schema([
					Checkbox::make('change_password')
						->label('Change Password?')
						->reactive()
						->visible(fn ($livewire) => $livewire instanceof Pages\EditUser),

					TextInput::make('password')
						->password()
						->label('Password')
						->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
						->dehydrated(fn ($state) => filled($state))
						->required(fn ($livewire, $get) =>
							$livewire instanceof Pages\CreateUser || $get('change_password'))
						->visible(fn ($livewire, $get) =>
							$livewire instanceof Pages\CreateUser || $get('change_password')),

					TextInput::make('password_confirmation')
						->password()
						->label('Confirm Password')
						->same('password')
						->required(fn ($livewire, $get) =>
							$livewire instanceof Pages\CreateUser || $get('change_password'))
						->visible(fn ($livewire, $get) =>
							$livewire instanceof Pages\CreateUser || $get('change_password')),
				])
				->columns(1)
				->columnSpan('full'),
			
            TextInput::make('company_name')
                ->required(),

            Textarea::make('address')
                ->rows(3)
                ->placeholder('Multiline address...')
                ->required(false),

            TextInput::make('full_name')
                ->label('Full Name')
                ->required(),

            TextInput::make('phone')
                ->required(),

            TextInput::make('vat_nr')
                ->label('VAT Number')
                ->nullable(),

			FileUpload::make('logo_path')
				->label('Company Logo')
				->directory('logos')
				->image()
				->imageEditor()
				->imageResizeMode('contain') // Required for resize to work
				->imageResizeTargetWidth('300')
				->imageResizeUpscale(false) // Prevents enlarging small images
				->previewable(true)
				->nullable(),

            Select::make('dealer_id')
                ->label('Dealer')
                ->relationship('dealer', 'dealer_name')
                ->searchable()
                ->preload()
                ->required(fn ($get) => $get('role') !== 'admin')
                ->nullable(),

            Select::make('role')
                ->options([
                    'admin' => 'Admin',
                    'key_dealer' => 'Key Dealer',
                    'sub_dealer' => 'Sub Dealer',
                ])
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('company_name'),
                TextColumn::make('full_name'),
                TextColumn::make('role')->badge(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
