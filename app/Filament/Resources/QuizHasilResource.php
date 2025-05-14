<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizHasilResource\Pages;
use App\Filament\Resources\QuizHasilResource\RelationManagers;
use App\Models\QuizHasil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class QuizHasilResource extends Resource
{
    protected static ?string $model = QuizHasil::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Hasil Quiz';
    protected static ?string $pluralModelLabel = 'Hasil Quiz Peserta';
    protected static ?string $modelLabel = 'Hasil Quiz';
    protected static ?string $navigationGroup = 'Manajemen Soal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Peserta')
                    ->schema([
                        Forms\Components\Select::make('peserta_id')
                            ->relationship('peserta', 'name')
                            ->searchable()
                            ->required()
                            ->label('Nama Peserta'),
                    ]),

                Forms\Components\Section::make('Hasil Tes')
                    ->schema([
                        Forms\Components\Select::make('gaya_belajar')
                            ->options([
                                'visual' => 'Visual',
                                'auditori' => 'Auditori',
                                'kinestetik' => 'Kinestetik',
                                'readwrite' => 'Read/Write',
                            ])
                            ->required()
                            ->label('Gaya Belajar Dominan'),

                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('skor_visual')
                                    ->numeric()
                                    ->required()
                                    ->label('Skor Visual'),

                                Forms\Components\TextInput::make('skor_auditori')
                                    ->numeric()
                                    ->required()
                                    ->label('Skor Auditori'),

                                Forms\Components\TextInput::make('skor_kinestetik')
                                    ->numeric()
                                    ->required()
                                    ->label('Skor Kinestetik'),

                                Forms\Components\TextInput::make('skor_readwrite')
                                    ->numeric()
                                    ->required()
                                    ->label('Skor Read/Write'),
                            ])
                            ->columns(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('peserta.name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Peserta'),

                Tables\Columns\TextColumn::make('peserta.sekolah')
                    ->searchable()
                    ->label('Asal Sekolah'),

                Tables\Columns\TextColumn::make('gaya_belajar')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'visual' => 'info',
                        'auditori' => 'success',
                        'kinestetik' => 'warning',
                        'readwrite' => 'purple',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->label('Gaya Belajar'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->label('Tanggal Test'),

                Tables\Columns\TextColumn::make('skor_visual')
                    ->sortable()
                    ->label('Visual'),

                Tables\Columns\TextColumn::make('skor_auditori')
                    ->sortable()
                    ->label('Auditori'),

                Tables\Columns\TextColumn::make('skor_kinestetik')
                    ->sortable()
                    ->label('Kinestetik'),

                Tables\Columns\TextColumn::make('skor_readwrite')
                    ->sortable()
                    ->label('Read/Write'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gaya_belajar')
                    ->options([
                        'visual' => 'Visual',
                        'auditori' => 'Auditori',
                        'kinestetik' => 'Kinestetik',
                        'readwrite' => 'Read/Write',
                    ])
                    ->label('Gaya Belajar'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Tanggal Test'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageQuizHasils::route('/'),
            // 'view' => Pages\ViewQuizHasil::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Data Peserta')
                    ->schema([
                        Infolists\Components\TextEntry::make('peserta.name')
                            ->label('Nama Peserta'),

                        Infolists\Components\TextEntry::make('peserta.sekolah')
                            ->label('Asal Sekolah'),

                        Infolists\Components\TextEntry::make('peserta.provinsi')
                            ->label('Provinsi'),

                        Infolists\Components\TextEntry::make('peserta.kota')
                            ->label('Kota/Kabupaten'),

                        Infolists\Components\TextEntry::make('peserta.email_guru')
                            ->label('Email Guru')
                            ->copyable(),

                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('peserta.nomor_whatsapp_guru')
                                    ->label('WhatsApp Guru')
                                    ->copyable()
                                    ->url(fn($record) => "https://wa.me/{$record->peserta->nomor_whatsapp_guru}")
                                    ->openUrlInNewTab(),

                                Infolists\Components\TextEntry::make('peserta.nomor_whatsapp_orang_tua')
                                    ->label('WhatsApp Orang Tua')
                                    ->copyable()
                                    ->url(fn($record) => "https://wa.me/{$record->peserta->nomor_whatsapp_orang_tua}")
                                    ->openUrlInNewTab(),
                            ]),
                    ]),

                Infolists\Components\Section::make('Hasil Tes')
                    ->schema([
                        Infolists\Components\TextEntry::make('gaya_belajar')
                            ->label('Gaya Belajar Dominan')
                            ->formatStateUsing(fn(string $state): string => ucfirst($state))
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'visual' => 'info',
                                'auditori' => 'success',
                                'kinestetik' => 'warning',
                                'readwrite' => 'purple',
                                default => 'gray',
                            }),

                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('skor_visual')
                                    ->label('Skor Visual'),

                                Infolists\Components\TextEntry::make('skor_auditori')
                                    ->label('Skor Auditori'),

                                Infolists\Components\TextEntry::make('skor_kinestetik')
                                    ->label('Skor Kinestetik'),

                                Infolists\Components\TextEntry::make('skor_readwrite')
                                    ->label('Skor Read/Write'),
                            ]),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Tanggal Test')
                            ->dateTime('d M Y H:i'),
                    ]),
            ]);
    }
}
