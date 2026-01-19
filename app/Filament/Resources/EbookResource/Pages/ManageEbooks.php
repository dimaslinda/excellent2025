<?php

namespace App\Filament\Resources\EbookResource\Pages;

use App\Filament\Resources\EbookResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageEbooks extends ManageRecords
{
    protected static string $resource = EbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah E-Book')
                ->successNotification(null)
                ->after(function ($record) {
                    Notification::make()
                        ->title('Saved')
                        ->color('success')
                        ->body("E-Book {$record->name} berhasil ditambahkan!")
                        ->success()
                        ->duration(3000)
                        ->send();
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Data E-Book';
    }
}

