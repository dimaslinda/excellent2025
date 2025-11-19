<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\QuizHasilResource;
use App\Models\QuizHasil;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class LatestAssessmentsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 4;

    protected function getTableQuery(): Builder|Relation|null
    {
        return QuizHasil::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('peserta.name')
                ->label('Peserta')
                ->limit(24)
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->dateTime('d M Y H:i')
                ->sortable(),
            Tables\Columns\TextColumn::make('gaya_belajar')
                ->label('Gaya Dominan')
                ->badge()
                ->sortable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->label('View')
                ->url(fn ($record) => QuizHasilResource::getUrl('view', ['record' => $record]))
                ->openUrlInNewTab(),
        ];
    }
}