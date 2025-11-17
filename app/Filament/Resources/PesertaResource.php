<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesertaResource\Pages;
use App\Models\Peserta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PesertaResource extends Resource
{
    protected static ?string $model = Peserta::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Peserta';
    protected static ?string $pluralModelLabel = 'Peserta';
    protected static ?string $modelLabel = 'Peserta';
    protected static ?string $navigationGroup = 'Assessment';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama')->required(),
                TextInput::make('sekolah')->label('Asal Sekolah')->required(),
                Select::make('jenjang')
                    ->label('Jenjang')
                    ->options([
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                    ])->required()->reactive()
                    ->afterStateUpdated(function (Forms\Set $set, $state) {
                        if ($state !== 'SD') {
                            $set('tingkatan_sd', null);
                        }
                    }),
                Select::make('tingkatan_sd')
                    ->label('Tingkatan SD')
                    ->options([
                        'rendah' => 'Rendah (Kelas 1–3)',
                        'tinggi' => 'Tinggi (Kelas 4–6)',
                    ])->visible(fn(Forms\Get $get) => $get('jenjang') === 'SD')->nullable(),
                TextInput::make('provinsi')->label('Provinsi')->required(),
                TextInput::make('kota')->label('Kota/Kabupaten')->required(),
                TextInput::make('nomor_whatsapp_orang_tua')->label('WA Orang Tua')->numeric()->maxLength(20)->required(),
                TextInput::make('nomor_whatsapp_guru')->label('WA Guru')->numeric()->maxLength(20)->required(),
                TextInput::make('email_guru')->label('Email Guru')->email()->required(),
                TextInput::make('nisn')->label('NISN')->maxLength(20),
                SpatieMediaLibraryFileUpload::make('photo')
                    ->label('Foto')
                    ->collection('photo')
                    ->image()
                    ->disk('gcs')
                    ->helperText('Foto disimpan menggunakan Spatie Media Library.')
                    ->columnSpanFull(),
                Toggle::make('is_dummy')->label('Dummy')->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_path')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl('/img/general/user-default.png')
                    ->getStateUsing(function ($record) {
                        // Prioritaskan media library
                        $mediaUrl = method_exists($record, 'getFirstMediaUrl') ? $record->getFirstMediaUrl('photo') : null;
                        if ($mediaUrl) {
                            return $mediaUrl;
                        }

                        // Fallback ke kolom lama jika belum migrasi penuh
                        $value = $record->foto_path;
                        if (!$value) return null;

                        // Jika sudah URL penuh, gunakan apa adanya
                        if (Str::startsWith($value, ['http://', 'https://'])) {
                            return $value;
                        }

                        // Jika sudah berupa path /storage, gunakan apa adanya
                        if (Str::startsWith($value, ['/storage/', 'storage/'])) {
                            return Str::startsWith($value, '/') ? $value : ('/' . $value);
                        }

                        // Bangun URL berdasarkan disk yang digunakan
                        if (config('filesystems.default') === 'gcs') {
                            $bucket = config('filesystems.disks.gcs.bucket');
                            $path = ltrim($value, '/');
                            return "https://storage.googleapis.com/{$bucket}/{$path}";
                        }

                        // Untuk disk 'public', susun URL ke symlink storage
                        return '/storage/' . ltrim($value, '/');
                    }),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('sekolah')->label('Sekolah')->limit(30)->searchable()->sortable(),
                TextColumn::make('jenjang')->label('Jenjang')->badge()->sortable(),
                TextColumn::make('tingkatan_sd')->label('Tingkat SD')
                    ->formatStateUsing(fn($state, Peserta $record) => $record->jenjang === 'SD'
                        ? ($state === 'rendah' ? 'Rendah (1–3)' : ($state === 'tinggi' ? 'Tinggi (4–6)' : '-'))
                        : '-')
                    ->sortable(),
                TextColumn::make('provinsi')->label('Provinsi')->sortable(),
                TextColumn::make('kota')->label('Kota/Kab')->sortable(),
                TextColumn::make('nisn')->label('NISN')->toggleable(),
            ])
            ->filters([
                SelectFilter::make('jenjang')->options(['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA']),
                SelectFilter::make('tingkatan_sd')->options(['rendah' => 'Rendah (1–3)', 'tinggi' => 'Tinggi (4–6)']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesertas::route('/'),
            'create' => Pages\CreatePeserta::route('/create'),
            'edit' => Pages\EditPeserta::route('/{record}/edit'),
        ];
    }
}
