<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizSoalResource\Pages;
use App\Filament\Resources\QuizSoalResource\RelationManagers\JawabanRelationManager;
use App\Models\QuizSoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class QuizSoalResource extends Resource
{
    protected static ?string $model = QuizSoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Soal Quiz';
    protected static ?string $pluralModelLabel = 'Soal Quiz';
    protected static ?string $modelLabel = 'Soal Quiz';
    protected static ?string $navigationGroup = 'Assessment';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Soal')
                    ->description('Isi pertanyaan dan metadata. Tingkatan SD hanya muncul jika jenjang adalah SD.')
                    ->columns(12)
                    ->schema([
                        Textarea::make('pertanyaan')
                            ->label('Pertanyaan')
                            ->required()
                            ->rows(4)
                            ->columnSpan(12),

                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Gambar (Opsional)')
                            ->collection('quiz_soal_images')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(10240)
                            ->disk(config('filesystems.default') === 'gcs' ? 'gcs' : 'public')
                            ->helperText('Opsional: unggah gambar pendukung untuk soal ini (Spatie Media Library).')
                            ->columnSpan(12),

                        Select::make('jenjang')
                            ->options([
                                'SD' => 'SD',
                                'SMP' => 'SMP',
                                'SMA' => 'SMA',
                            ])
                            ->required()
                            ->reactive()
                            ->helperText('Pilih jenjang pertanyaan.')
                            ->afterStateUpdated(function (Forms\Set $set, $state) {
                                if ($state !== 'SD') {
                                    $set('tingkatan_sd', null);
                                }
                            })
                            ->columnSpan(12),

                        Select::make('tingkatan_sd')
                            ->label('Tingkatan SD')
                            ->options([
                                'rendah' => 'Rendah (Kelas 1–3)',
                                'tinggi' => 'Tinggi (Kelas 4–6)',
                            ])
                            ->visible(fn (Forms\Get $get) => $get('jenjang') === 'SD')
                            ->nullable()
                            ->columnSpan(12),

                        // Urutan ditetapkan otomatis saat create; tidak perlu input manual

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inlineLabel(false)
                            ->columnSpan(12),
                    ]),

                Section::make('Pilihan Jawaban')
                    ->collapsible()
                    ->collapsed(false)
                    ->description('Tambah pilihan jawaban. Seret untuk mengurutkan; urutan tersimpan otomatis.')
                    ->schema([
                        Repeater::make('jawaban')
                            ->label('Jawaban')
                            ->relationship('jawaban')
                            ->orderable('urutan')
                            ->default([
                                ['jawaban' => '', 'gaya_belajar' => null],
                                ['jawaban' => '', 'gaya_belajar' => null],
                                ['jawaban' => '', 'gaya_belajar' => null],
                                ['jawaban' => '', 'gaya_belajar' => null],
                            ])
                            ->minItems(1)
                            ->createItemButtonLabel('Tambah Jawaban')
                            ->itemLabel(fn (array $state) => ($state['gaya_belajar'] ?? 'Jawaban'))
                            ->columns(12)
                            ->schema([
                                Textarea::make('jawaban')
                                    ->label('Teks Jawaban')
                                    ->rows(2)
                                    ->placeholder('Contoh: Saya lebih mudah belajar lewat gambar/video')
                                    ->required()
                                    ->columnSpan(8),
                                Select::make('gaya_belajar')
                                    ->label('Gaya Belajar')
                                    ->options([
                                        'visual' => 'Visual',
                                        'auditori' => 'Auditori',
                                        'kinestetik' => 'Kinestetik',
                                        'readwrite' => 'Read/Write',
                                    ])
                                    ->required()
                                    ->columnSpan(4),
                                // Kolom 'urutan' diisi otomatis oleh orderable() berdasarkan posisi drag
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->defaultImageUrl('/img/general/dummy.webp')
                    ->getStateUsing(function ($record) {
                        return method_exists($record, 'getFirstMediaUrl')
                            ? $record->getFirstMediaUrl('quiz_soal_images')
                            : null;
                    }),
                TextColumn::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->limit(80)
                    ->wrap(),
                TextColumn::make('jenjang')
                    ->badge()
                    ->label('Jenjang')
                    ->sortable(),
                TextColumn::make('tingkatan_sd')
                    ->label('Tingkatan SD')
                    ->formatStateUsing(fn ($state, QuizSoal $record) => $record->jenjang === 'SD'
                        ? ($state === 'rendah' ? 'Rendah (Kelas 1–3)' : ($state === 'tinggi' ? 'Tinggi (Kelas 4–6)' : '-'))
                        : '-')
                    ->sortable(),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenjang')
                    ->label('Jenjang')
                    ->options([
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                    ]),
                SelectFilter::make('tingkatan_sd')
                    ->label('Tingkatan SD')
                    ->options([
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
            'index' => Pages\ListQuizSoals::route('/'),
            'create' => Pages\CreateQuizSoal::route('/create'),
            'edit' => Pages\EditQuizSoal::route('/{record}/edit'),
        ];
    }
}
