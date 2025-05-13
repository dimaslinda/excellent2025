<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\GalleryResource;
use Filament\Resources\Pages\ManageRecords;

class ManageGalleries extends ManageRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Gallery')
                ->successNotification(null)
                ->after(function ($record) {
                    Notification::make()
                        ->title('Saved')
                        ->color('success')
                        ->body("Gallery {$record->name} berhasil ditambahkan!")
                        ->success()
                        ->duration(3000)
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Data Gallery';
    }
}
