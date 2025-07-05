<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListQuotes extends ListRecords
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
