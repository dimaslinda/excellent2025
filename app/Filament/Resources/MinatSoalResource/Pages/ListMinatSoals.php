<?php

namespace App\Filament\Resources\MinatSoalResource\Pages;

use App\Filament\Resources\MinatSoalResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListMinatSoals extends ListRecords
{
    protected static string $resource = MinatSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}