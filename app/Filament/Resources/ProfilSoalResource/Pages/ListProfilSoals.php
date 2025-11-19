<?php

namespace App\Filament\Resources\ProfilSoalResource\Pages;

use App\Filament\Resources\ProfilSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilSoals extends ListRecords
{
    protected static string $resource = ProfilSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}