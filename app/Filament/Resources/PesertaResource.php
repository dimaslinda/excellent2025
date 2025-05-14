<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesertaResource\Pages;
use App\Filament\Resources\PesertaResource\RelationManagers;
use App\Models\Peserta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;

class PesertaResource extends Resource
{
    protected static ?string $model = Peserta::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Data Peserta';

    protected static ?string $modelLabel = 'Peserta';

    protected static ?string $pluralModelLabel = 'Peserta';

    protected static ?string $navigationGroup = 'Manajemen Pengguna';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Siswa')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sekolah')
                            ->label('Asal Sekolah')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Data Lokasi')
                    ->schema([
                        Forms\Components\Select::make('provinsi')
                            ->label('Provinsi')
                            ->options(Province::pluck('name', 'code'))
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if (!$state) {
                                    $set('kota_kabupaten', null);
                                }
                            }),
                        Forms\Components\Select::make('kota')
                            ->label('Kota/Kabupaten')
                            ->options(function (Forms\Get $get) {
                                $provinceCode = $get('provinsi');
                                if (!$provinceCode) {
                                    return [];
                                }
                                return City::where('province_code', $provinceCode)
                                    ->pluck('name', 'code');
                            })
                            ->required()
                            ->disabled(fn(Forms\Get $get) => !$get('provinsi')),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_whatsapp_orang_tua')
                            ->label('Nomor WhatsApp Orang Tua')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nomor_whatsapp_guru')
                            ->label('Nomor WhatsApp Guru')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email_guru')
                            ->label('Email Guru')
                            ->required()
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sekolah')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('provinsi')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kota')
                    ->label('Kota/Kabupaten')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_whatsapp_orang_tua')
                    ->label('No. WA Orang Tua')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_whatsapp_guru')
                    ->label('No. WA Guru')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_guru')
                    ->label('Email Guru')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManagePesertas::route('/'),
        ];
    }
}
