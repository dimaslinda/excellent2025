<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EbookResource\Pages;
use App\Models\Ebook;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EbookResource extends Resource
{
    protected static ?string $model = Ebook::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data E-Book';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Judul E-Book')
                        ->placeholder('Contoh: Panduan Implementasi Kurikulum Merdeka')
                        ->required(),
                    TextInput::make('author')
                        ->label('Penulis')
                        ->placeholder('Nama penulis atau tim penyusun')
                        ->maxLength(255),
                    TextInput::make('level')
                        ->label('Segmentasi Pembaca')
                        ->placeholder('Contoh: Guru SD, Siswa SMP, Orang Tua'),
                    Textarea::make('description')
                        ->label('Deskripsi Singkat')
                        ->placeholder('Tuliskan deskripsi singkat yang menjelaskan manfaat utama e-book ini')
                        ->rows(4),
                    SpatieMediaLibraryFileUpload::make('cover')
                        ->label('Thumbnail E-Book')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->collection('ebook_cover')
                        ->image()
                        ->imageEditorAspectRatios([
                            '3:4',
                            '4:3',
                            '1:1',
                        ])
                        ->maxSize(10024)
                        ->hint('Gunakan gambar cover yang tajam dan mudah dibaca, maksimal 10 MB')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintColor('warning')
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),
                    SpatieMediaLibraryFileUpload::make('file')
                        ->label('File E-Book')
                        ->required()
                        ->disk('gcs')
                        ->collection('ebook_file')
                        ->maxSize(20480)
                        ->hint('Unggah file e-book dalam format PDF, maksimal 20 MB')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintColor('warning')
                        ->acceptedFileTypes(['application/pdf']),
                    Forms\Components\Toggle::make('is_published')
                        ->label('Tampilkan di Halaman E-Book')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Judul E-Book')
                    ->wrap()
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('level')
                    ->label('Segmentasi')
                    ->alignCenter()
                    ->toggleable(),
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('Thumbnail')
                    ->alignCenter()
                    ->width(120)
                    ->height(160)
                    ->collection('ebook_cover'),
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
                            ->body("Data E-Book {$record->name} berhasil diubah!")
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
                            ->body("Data E-Book {$record->name} berhasil dihapus!")
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
            'index' => Pages\ManageEbooks::route('/'),
        ];
    }
}

