<?php

namespace App\Filament\Resources\QuizSoalResource\Pages;

use App\Filament\Resources\QuizSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizSoal extends EditRecord
{
    protected static string $resource = QuizSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
