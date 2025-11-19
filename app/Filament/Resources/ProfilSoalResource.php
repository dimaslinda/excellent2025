<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilSoalResource\Pages;
use App\Models\ProfilSoal;
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

class ProfilSoalResource extends Resource
{
    protected static ?string $model = ProfilSoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Profil Siswa';
    protected static ?string $pluralModelLabel = 'Pertanyaan Profil Siswa';
    protected static ?string $modelLabel = 'Pertanyaan Profil Siswa';
    protected static ?string $navigationGroup = 'Assessment';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Pertanyaan')
                    ->description('Atur pertanyaan Profil Siswa, struktur sama seperti Minat (bisa per jenjang, Tingkatan SD opsional).')
                    ->columns(2)
                    ->schema([
                        Textarea::make('pertanyaan')
                            ->label('Pertanyaan')
                            ->rows(3)
                            ->placeholder('Tulis pertanyaan profil siswa')
                            ->required()
                            ->columnSpan(2),

                        Select::make('jenjang')
                            ->label('Jenjang')
                            ->options([
                                'SD' => 'SD',
                                'SMP' => 'SMP',
                                'SMA' => 'SMA',
                            ])
                            ->nullable()
                            ->reactive()
                            ->helperText('Opsional: kosongkan untuk pertanyaan global semua jenjang.')
                            ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                                if ($state !== 'SD') {
                                    $set('tingkatan_sd', null);
                                }
                            })
                            ->columnSpan(2),

                        Select::make('tingkatan_sd')
                            ->label('Tingkatan SD')
                            ->options([
                                'rendah' => 'Rendah (Kelas 1–3)',
                                'tinggi' => 'Tinggi (Kelas 4–6)',
                            ])
                            ->visible(fn(\Filament\Forms\Get $get) => $get('jenjang') === 'SD')
                            ->nullable()
                            ->helperText('Opsional: kosongkan agar berlaku untuk semua tingkatan SD.')
                            ->columnSpan(2),

                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Gambar (Opsional)')
                            ->collection('profil_soal_images')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(10240)
                            ->disk('gcs')
                            ->helperText('Opsional: unggah gambar pendukung untuk pertanyaan ini.')
                            ->columnSpan(2),
                        Hidden::make('urutan')->default(0),
                        Toggle::make('is_active')->label('Aktif')->default(true)->inline(false)->columnSpan(2),
                    ]),

                Section::make('Pilihan Jawaban')
                    ->description('Susun pilihan sesuai urutan drag. Minimal satu pilihan aktif.')
                    ->collapsible()
                    ->collapsed(false)
                    ->schema([
                        Repeater::make('jawaban')
                            ->label('Jawaban')
                            ->relationship('jawaban')
                            ->orderable('urutan')
                            ->collapsed(false)
                            ->minItems(1)
                            ->default([
                                ['kode' => 'A', 'label' => '', 'value' => '', 'urutan' => 1, 'is_active' => true],
                                ['kode' => 'B', 'label' => '', 'value' => '', 'urutan' => 2, 'is_active' => true],
                                ['kode' => 'C', 'label' => '', 'value' => '', 'urutan' => 3, 'is_active' => true],
                                ['kode' => 'D', 'label' => '', 'value' => '', 'urutan' => 4, 'is_active' => true],
                            ])
                            ->itemLabel(fn(array $state) => ($state['kode'] ?? '-') . ' — ' . (($state['label'] ?? '') ?: 'Pilihan'))
                            ->createItemButtonLabel('Tambah Jawaban')
                            ->columns(12)
                            ->schema([
                                TextInput::make('kode')->label('Kode (A/B/C/D)')->maxLength(1)->required()->columnSpan(2),
                                TextInput::make('label')->label('Label Jawaban')->required()->columnSpan(6),
                                TextInput::make('value')->label('Nilai Hasil (disimpan)')->required()->columnSpan(2),
                                SpatieMediaLibraryFileUpload::make('answer_images')
                                    ->label('Gambar Jawaban (Opsional)')
                                    ->collection('answer_images')
                                    ->image()
                                    ->acceptedFileTypes(['image/*'])
                                    ->maxSize(10240)
                                    ->disk('gcs')
                                    ->columnSpan(12),
                                Hidden::make('urutan')->default(0),
                                Toggle::make('is_active')->label('Aktif')->default(true)->inline(false)->columnSpan(1),
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
                            ? $record->getFirstMediaUrl('profil_soal_images')
                            : null;
                    }),
                TextColumn::make('pertanyaan')->label('Pertanyaan')->limit(80)->wrap(),
                TextColumn::make('jenjang')->label('Jenjang')->badge()->sortable(),
                TextColumn::make('tingkatan_sd')
                    ->label('Tingkatan SD')
                    ->formatStateUsing(fn($state, \App\Models\ProfilSoal $record) => $record->jenjang === 'SD'
                        ? ($state === 'rendah' ? 'Rendah (Kelas 1–3)' : ($state === 'tinggi' ? 'Tinggi (Kelas 4–6)' : '-'))
                        : '-')
                    ->sortable(),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('jenjang')->label('Jenjang')->options([
                    'SD' => 'SD',
                    'SMP' => 'SMP',
                    'SMA' => 'SMA',
                ]),
                SelectFilter::make('tingkatan_sd')->label('Tingkatan SD')->options([
                    'rendah' => 'Rendah (Kelas 1–3)',
                    'tinggi' => 'Tinggi (Kelas 4–6)',
                ]),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfilSoals::route('/'),
            'create' => Pages\CreateProfilSoal::route('/create'),
            'edit' => Pages\EditProfilSoal::route('/{record}/edit'),
        ];
    }
}
