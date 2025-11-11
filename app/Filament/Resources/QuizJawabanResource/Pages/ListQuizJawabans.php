<?php

namespace App\Filament\Resources\QuizJawabanResource\Pages;

use App\Filament\Resources\QuizJawabanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListQuizJawabans extends ListRecords
{
    protected static string $resource = QuizJawabanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}