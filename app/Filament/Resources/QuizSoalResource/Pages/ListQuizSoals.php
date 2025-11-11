<?php

namespace App\Filament\Resources\QuizSoalResource\Pages;

use App\Filament\Resources\QuizSoalResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListQuizSoals extends ListRecords
{
    protected static string $resource = QuizSoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
