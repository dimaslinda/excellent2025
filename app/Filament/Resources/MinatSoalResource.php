<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MinatSoalResource\Pages;
use App\Filament\Resources\MinatSoalResource\RelationManagers\JawabanRelationManager;
use App\Models\MinatSoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class MinatSoalResource extends Resource
{
    protected static ?string $model = MinatSoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Pertanyaan Minat';
    protected static ?string $pluralModelLabel = 'Pertanyaan Minat';
    protected static ?string $modelLabel = 'Pertanyaan Minat';
    protected static ?string $navigationGroup = 'Assessment';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Pertanyaan')
                    ->description('Pertanyaan Minat bersifat global. Urutan otomatis, toggle aktif untuk tampil di assessment.')
                    ->columns(2)
                    ->schema([
                        Textarea::make('pertanyaan')
                            ->label('Pertanyaan')
                            ->rows(3)
                            ->placeholder('Tulis pertanyaan minat yang jelas dan ringkas')
                            ->required()
                            ->columnSpan(2),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Gambar (Opsional)')
                            ->collection('minat_soal_images')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(10240)
                            ->disk(config('filesystems.default') === 'gcs' ? 'gcs' : 'public')
                            ->helperText('Opsional: unggah gambar pendukung untuk pertanyaan ini (Spatie Media Library).')
                            ->columnSpan(2),
                        // Kolom 'urutan' disembunyikan dan diisi otomatis saat create
                        Hidden::make('urutan')->default(0),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(2),
                    ]),

                Section::make('Pilihan Jawaban')
                    ->description('Susun pilihan sesuai urutan drag. Minimal satu pilihan aktif.')
                    ->collapsible()
                    ->collapsed(false)
                    ->schema([
                        // Jawaban inline supaya pembuatan pertanyaan & jawaban jadi satu alur
                        Repeater::make('jawaban')
                            ->label('Jawaban')
                            ->relationship('jawaban')
                            ->orderable('urutan')
                            ->collapsed(false)
                            ->minItems(1)
                            // Default 4 opsi (A–D), boleh dihapus/ditambah — tidak wajib persis 4
                            ->default([
                                ['kode' => 'A', 'label' => '', 'value' => '', 'urutan' => 1, 'is_active' => true],
                                ['kode' => 'B', 'label' => '', 'value' => '', 'urutan' => 2, 'is_active' => true],
                                ['kode' => 'C', 'label' => '', 'value' => '', 'urutan' => 3, 'is_active' => true],
                                ['kode' => 'D', 'label' => '', 'value' => '', 'urutan' => 4, 'is_active' => true],
                            ])
                            ->itemLabel(fn (array $state) => ($state['kode'] ?? '-') . ' — ' . (($state['label'] ?? '') ?: 'Pilihan'))
                            ->createItemButtonLabel('Tambah Jawaban')
                            ->columns(12)
                            ->schema([
                                TextInput::make('kode')
                                    ->label('Kode (A/B/C/D)')
                                    ->maxLength(1)
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('label')
                                    ->label('Label Jawaban')
                                    ->placeholder('Contoh: Belajar dengan video/gambar')
                                    ->required()
                                    ->columnSpan(6),
                                TextInput::make('value')
                                    ->label('Nilai Hasil (disimpan)')
                                    ->placeholder('Contoh: device_mobile / place_home')
                                    ->required()
                                    ->columnSpan(2),
                                // Kolom 'urutan' disembunyikan; nilai mengikuti drag order
                                Hidden::make('urutan')->default(0),
                                Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true)
                                    ->inline(false)
                                    ->columnSpan(1),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('urutan')
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->defaultImageUrl('/img/general/dummy.webp')
                    ->getStateUsing(function ($record) {
                        return method_exists($record, 'getFirstMediaUrl')
                            ? $record->getFirstMediaUrl('minat_soal_images')
                            : null;
                    }),
                TextColumn::make('pertanyaan')->label('Pertanyaan')->limit(80)->wrap(),
                ToggleColumn::make('is_active')->label('Aktif'),
                // Kolom urutan disembunyikan dari tampilan; gunakan drag untuk menyusun
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('urutan');
    }

    public static function getRelations(): array
    {
        // Gunakan Repeater di form utama; tidak perlu RelationManager terpisah
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMinatSoals::route('/'),
            'create' => Pages\CreateMinatSoal::route('/create'),
            'edit' => Pages\EditMinatSoal::route('/{record}/edit'),
        ];
    }
}