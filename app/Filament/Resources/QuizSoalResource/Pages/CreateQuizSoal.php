<?php

namespace App\Filament\Resources\QuizSoalResource\Pages;

use App\Filament\Resources\QuizSoalResource;
use App\Models\QuizSoal;
use Filament\Resources\Pages\CreateRecord;

class CreateQuizSoal extends CreateRecord
{
    protected static string $resource = QuizSoalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Tentukan urutan otomatis berdasarkan jenjang & tingkatan SD (jika ada)
        $query = QuizSoal::query();
        if (!empty($data['jenjang'])) {
            $query->where('jenjang', $data['jenjang']);
            if ($data['jenjang'] === 'SD') {
                $query->where('tingkatan_sd', $data['tingkatan_sd'] ?? null);
            }
        }

        $maxOrder = (int) ($query->max('urutan') ?? 0);
        $data['urutan'] = $maxOrder + 1;

        return $data;
    }
}
