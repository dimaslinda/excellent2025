<?php

namespace App\Filament\Resources\QuizHasilResource\Pages;

use App\Filament\Resources\QuizHasilResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageQuizHasils extends ManageRecords
{
    protected static string $resource = QuizHasilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
