<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Modul;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ModulResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ModulResource\RelationManagers;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ModulResource extends Resource
{
    protected static ?string $model = Modul::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data Modul Ajar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Modul')
                        ->placeholder('Nama Modul')
                        ->required(),
                    TextInput::make('price')
                        ->placeholder('Harga Modul')
                        ->required(),
                    TextInput::make('link')
                        ->label('No. Whatsapp')
                        ->placeholder('ex : 6281234567890')
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->label('Foto Modul')
                        ->collection('modul')
                        ->image()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->maxSize(10024)
                        ->hint('Ukuran Maksimal 10 MB')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintColor('warning')
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Modul')
                    ->wrap()
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga Modul')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('link')
                    ->alignCenter()
                    ->label('No. Whatsapp')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto Modul')
                    ->alignCenter()
                    ->width(150)
                    ->height(150)
                    ->collection('modul'),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->alignCenter()
                    ->label('Dibuat')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->successNotification(null)
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Updated')
                            ->color('success')
                            ->body("Data Modul Ajar {$record->name} berhasil diubah!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Deleted')
                            ->color('danger')
                            ->icon('heroicon-s-trash')
                            ->iconColor('danger')
                            ->body("Data Modul Ajar {$record->name} berhasil dihapus!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageModuls::route('/'),
        ];
    }
}
