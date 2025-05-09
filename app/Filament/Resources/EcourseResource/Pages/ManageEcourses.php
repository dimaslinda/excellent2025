<?php

namespace App\Filament\Resources\EcourseResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\EcourseResource;
use Filament\Resources\Pages\ManageRecords;

class ManageEcourses extends ManageRecords
{
    protected static string $resource = EcourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Ecourse')
                ->successNotification(null)
                ->after(function ($record) {
                    Notification::make()
                        ->title('Saved')
                        ->color('success')
                        ->body("Ecourse {$record->name} berhasil ditambahkan!")
                        ->success()
                        ->duration(3000)
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Data E-Course';
    }
}
