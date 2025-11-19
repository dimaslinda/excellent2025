<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizHasilResource\Pages;
use App\Models\QuizHasil;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class QuizHasilResource extends Resource
{
    protected static ?string $model = QuizHasil::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Hasil Quiz';
    protected static ?string $pluralModelLabel = 'Hasil Quiz';
    protected static ?string $modelLabel = 'Hasil Quiz';
    protected static ?string $navigationGroup = 'Assessment';
    protected static ?int $navigationSort = 12;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('peserta.name')->label('Peserta')->searchable()->sortable(),
                TextColumn::make('gaya_belajar')->label('Gaya Belajar')->badge()->sortable(),
                TextColumn::make('skor_visual')->label('Visual')->sortable(),
                TextColumn::make('skor_auditori')->label('Auditori')->sortable(),
                TextColumn::make('skor_kinestetik')->label('Kinestetik')->sortable(),
                TextColumn::make('skor_readwrite')->label('Read/Write')->sortable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gaya_belajar')
                    ->options([
                        'visual' => 'Visual',
                        'auditori' => 'Auditori',
                        'kinestetik' => 'Kinestetik',
                        'readwrite' => 'Read/Write',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizHasils::route('/'),
            'view' => Pages\ViewQuizHasil::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make('Ringkasan Profil Siswa')
                    ->description('Ringkasan jawaban Profil Siswa yang diisi peserta.')
                    ->columns(1)
                    ->visible(fn ($record) => !empty($record->profil_summary))
                    ->schema([
                        RepeatableEntry::make('profil_summary')
                            ->label('Jawaban Profil')
                            ->schema([
                                TextEntry::make('pertanyaan')->label('Pertanyaan'),
                                TextEntry::make('kode')->label('Kode')->badge(),
                                TextEntry::make('label')->label('Pilihan'),
                                TextEntry::make('value')->label('Nilai')->badge(),
                            ])
                            ->contained(false)
                            ->columnSpanFull(),
                    ]),

                InfoSection::make('Profil Siswa')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('peserta.name')->label('Nama') ,
                        TextEntry::make('peserta.sekolah')->label('Sekolah'),
                        TextEntry::make('peserta.jenjang')->label('Jenjang'),
                        TextEntry::make('peserta.tingkatan_sd')->label('Tingkatan SD')
                            ->formatStateUsing(fn ($state, $record) => ($record->peserta?->jenjang === 'SD') ? ($state ?: '-') : '-'),
                        TextEntry::make('peserta.provinsi')->label('Provinsi'),
                        TextEntry::make('peserta.kota')->label('Kota/Kabupaten'),
                        TextEntry::make('peserta.nomor_whatsapp_orang_tua')->label('WA Orang Tua'),
                        TextEntry::make('peserta.email_guru')->label('Email Guru'),
                    ]),

                InfoSection::make('Hasil Quiz (Gaya Belajar)')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('gaya_belajar')->label('Gaya Belajar')->badge()
                            ->color(fn ($state) => match ($state) {
                                'visual' => 'info',
                                'auditori' => 'warning',
                                'kinestetik' => 'success',
                                'readwrite' => 'primary',
                                default => 'gray',
                            }),
                        TextEntry::make('created_at')->label('Tanggal')->dateTime(),
                        TextEntry::make('skor_visual')->label('Skor Visual'),
                        TextEntry::make('skor_auditori')->label('Skor Auditori'),
                        TextEntry::make('skor_kinestetik')->label('Skor Kinestetik'),
                        TextEntry::make('skor_readwrite')->label('Skor Read/Write'),
                    ]),

                InfoSection::make('Ringkasan Minat Belajar')
                    ->description('Ringkasan preferensi belajar sesuai pilihan siswa.')
                    ->columns(1)
                    ->visible(fn ($record) => !empty($record->minat_summary))
                    ->schema([
                        RepeatableEntry::make('minat_summary')
                            ->label('Pilihan Minat')
                            ->schema([
                                TextEntry::make('pertanyaan')->label('Pertanyaan'),
                                TextEntry::make('label')->label('Pilihan'),
                                TextEntry::make('value')->label('Tingkat')->badge()
                                    ->color(fn ($state) => match ($state) {
                                        'tinggi' => 'success',
                                        'sedang' => 'warning',
                                        'rendah' => 'gray',
                                        default => 'primary',
                                    }),
                            ])
                            ->contained(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
