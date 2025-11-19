<?php

namespace App\Filament\Widgets;

use App\Models\QuizHasil;
use Filament\Widgets\ChartWidget;

class LearningStyleDonutWidget extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Gaya Belajar';
    protected int|string|array $columnSpan = [
        'sm' => 12,
        'lg' => 6,
    ];
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $labels = ['Visual', 'Auditori', 'Kinestetik', 'Read/Write'];
        $map = [
            'visual' => 'Visual',
            'auditori' => 'Auditori',
            'kinestetik' => 'Kinestetik',
            'readwrite' => 'Read/Write',
        ];

        $counts = [0, 0, 0, 0];

        foreach ($map as $key => $label) {
            $index = array_search($label, $labels, true);
            $counts[$index] = QuizHasil::where('gaya_belajar', $key)->count();
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Gaya Belajar',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#60A5FA', // Visual - Blue
                        '#F59E0B', // Auditori - Amber
                        '#34D399', // Kinestetik - Green
                        '#EF4444', // Read/Write - Red
                    ],
                    'borderColor' => [
                        '#3B82F6',
                        '#D97706',
                        '#10B981',
                        '#DC2626',
                    ],
                    'borderWidth' => 1,
                    'hoverOffset' => 6,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}