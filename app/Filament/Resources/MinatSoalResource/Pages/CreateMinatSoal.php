<?php

namespace App\Filament\Resources\MinatSoalResource\Pages;

use App\Filament\Resources\MinatSoalResource;
use App\Models\MinatSoal;
use Filament\Resources\Pages\CreateRecord;

class CreateMinatSoal extends CreateRecord
{
    protected static string $resource = MinatSoalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Otomatisasi urutan pertanyaan: ambil nilai maksimum lalu +1
        $nextOrder = (int) (MinatSoal::max('urutan') ?? 0) + 1;
        $data['urutan'] = $nextOrder;
        return $data;
    }
}