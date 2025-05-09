<?php

namespace App\Filament\Resources\BootcampResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\BootcampResource;

class ManageBootcamps extends ManageRecords
{
    protected static string $resource = BootcampResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Bootcamp')
                ->successNotification(null)
                ->after(function ($record) {
                    Notification::make()
                        ->title('Saved')
                        ->color('success')
                        ->body("Bootcamp {$record->name} berhasil ditambahkan!")
                        ->success()
                        ->duration(3000)
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Data Bootcamp';
    }
}
