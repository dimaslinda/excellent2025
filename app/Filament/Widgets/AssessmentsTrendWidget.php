<?php

namespace App\Filament\Widgets;

use App\Models\QuizHasil;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;

class AssessmentsTrendWidget extends ChartWidget
{
    protected static ?string $heading = 'Tren Harian Assessment (14 Hari)';
    protected int|string|array $columnSpan = [
        'sm' => 12,
        'lg' => 6,
    ];
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $start = Carbon::today()->subDays(13);
        $dates = collect(range(0, 13))->map(fn ($d) => $start->copy()->addDays($d));

        $labels = $dates->map->format('d M')->all();
        $data = $dates->map(fn ($date) => QuizHasil::whereDate('created_at', $date)->count())->all();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Assessment',
                    'data' => $data,
                    'borderColor' => '#F59E0B',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.25)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}