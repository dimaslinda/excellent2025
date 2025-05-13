<?php

namespace App\Filament\Resources\EkskulResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\EkskulResource;
use Filament\Resources\Pages\ManageRecords;

class ManageEkskuls extends ManageRecords
{
    protected static string $resource = EkskulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Ekskul')
                ->successNotification(null)
                ->after(function ($record) {
                    Notification::make()
                        ->title('Saved')
                        ->color('success')
                        ->body("Ekskul {$record->name} berhasil ditambahkan!")
                        ->success()
                        ->duration(3000)
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Data Ekskul';
    }
}
