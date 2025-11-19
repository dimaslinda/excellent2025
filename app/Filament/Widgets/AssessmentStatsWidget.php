<?php

namespace App\Filament\Widgets;

use App\Models\QuizHasil;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Carbon;

class AssessmentStatsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $total = QuizHasil::count();
        $today = QuizHasil::whereDate('created_at', Carbon::today())->count();

        $avgVisual = round((float) (QuizHasil::avg('skor_visual') ?? 0), 2);
        $avgAuditori = round((float) (QuizHasil::avg('skor_auditori') ?? 0), 2);
        $avgKinestetik = round((float) (QuizHasil::avg('skor_kinestetik') ?? 0), 2);
        $avgReadWrite = round((float) (QuizHasil::avg('skor_readwrite') ?? 0), 2);

        return [
            Card::make('Total Assessment', $total),
            Card::make('Assessment Hari Ini', $today),
            Card::make('Rata-rata Visual', $avgVisual),
            Card::make('Rata-rata Auditori', $avgAuditori),
            Card::make('Rata-rata Kinestetik', $avgKinestetik),
            Card::make('Rata-rata Read/Write', $avgReadWrite),
        ];
    }

    protected function getColumns(): int
    {
        // Jumlah kolom kartu statistik per baris
        return 3;
    }
}