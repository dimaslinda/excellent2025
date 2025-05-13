<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Gallery;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GalleryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\GalleryResource\RelationManagers;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data Gallery';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Gallery')
                            ->placeholder('Nama Gallery')
                            ->autocapitalize('words')
                            ->live(debounce: 500)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->placeholder('Slug')
                            ->unique(ignorable: fn($record) => $record)
                            ->readOnly()
                            ->required(),
                        TextInput::make('sekolah')
                            ->required(),
                        Toggle::make('publish')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(false),
                    ]),
                Section::make('Foto Gallery')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumb')
                            ->label('Foto Gallery')
                            ->required()
                            ->imageEditor()
                            ->disk('gcs')
                            ->collection('gallerythumb')
                            ->image()
                            ->directory('gallery')
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(10024)
                            ->hint('Ukuran Maksimal 10 MB')
                            ->hintIcon('heroicon-o-information-circle')
                            ->hintColor('warning')
                            ->required()
                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('another_portofolio')
                            ->label('gallery lainnya')
                            ->image()
                            ->disk('gcs')
                            ->multiple()
                            ->maxFiles(6)
                            ->reorderable()
                            ->directory('portofolios')
                            ->imageEditor()
                            ->reorderable()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(10024)
                            ->hint('Ukuran Maksimal 10 MB')
                            ->hintIcon('heroicon-o-information-circle')
                            ->hintColor('warning')
                            ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp'])
                            ->required(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Gallery')
                    ->wrap()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('sekolah')
                    ->alignCenter()
                    ->label('Sekolah')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('gallery')
                    ->label('Foto Gallery')
                    ->alignCenter()
                    ->width(50)
                    ->height(50)
                    ->limit(3)
                    ->circular()
                    ->stacked()
                    ->collection('another_portofolio'),
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
                            ->body("Data Gallery {$record->name} berhasil diubah!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Updated')
                            ->color('success')
                            ->body("Data Gallery {$record->name} berhasil diubah!")
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
            'index' => Pages\ManageGalleries::route('/'),
        ];
    }
}
