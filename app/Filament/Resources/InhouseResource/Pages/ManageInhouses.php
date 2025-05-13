<?php

namespace App\Filament\Resources\InhouseResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\InhouseResource;
use Filament\Resources\Pages\ManageRecords;

class ManageInhouses extends ManageRecords
{
    protected static string $resource = InhouseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Inhouse Training')
                ->successNotification(null)
                ->after(function ($record) {
                    Notification::make()
                        ->title('Saved')
                        ->color('success')
                        ->body("Inhouse Training {$record->name} berhasil ditambahkan!")
                        ->success()
                        ->duration(3000)
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Data Inhouse Training';
    }
}
