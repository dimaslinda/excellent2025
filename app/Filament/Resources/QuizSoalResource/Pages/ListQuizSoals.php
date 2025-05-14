<?php

namespace App\Filament\Resources\QuizSoalResource\Pages;

use App\Filament\Resources\QuizSoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
