<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizJawabanResource\Pages;
use App\Models\QuizJawaban;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class QuizJawabanResource extends Resource
{
    protected static ?string $model = QuizJawaban::class;

    // Hide standalone Jawaban navigation; manage answers inline under Soal Quiz
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Jawaban Quiz';
    protected static ?string $pluralModelLabel = 'Jawaban Quiz';
    protected static ?string $modelLabel = 'Jawaban Quiz';
    protected static ?string $navigationGroup = 'Assessment';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('soal_id')
                    ->relationship('soal', 'pertanyaan')
                    ->label('Soal')
                    ->searchable()
                    ->required(),
                Textarea::make('jawaban')
                    ->label('Jawaban')
                    ->required()
                    ->rows(3),
                Select::make('gaya_belajar')
                    ->label('Gaya Belajar')
                    ->options([
                        'visual' => 'Visual',
                        'auditori' => 'Auditori',
                        'kinestetik' => 'Kinestetik',
                        'readwrite' => 'Read/Write',
                    ])
                    ->required(),
                SpatieMediaLibraryFileUpload::make('answer_images')
                    ->label('Gambar Jawaban (Opsional)')
                    ->collection('answer_images')
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->maxSize(10240)
                    ->disk('gcs'),
                TextInput::make('urutan')
                    ->numeric()
                    ->label('Urutan')
                    ->required(),
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
                            ? $record->getFirstMediaUrl('answer_images')
                            : null;
                    }),
                TextColumn::make('soal.pertanyaan')
                    ->label('Soal')
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('jawaban')
                    ->label('Jawaban')
                    ->limit(80)
                    ->wrap(),
                TextColumn::make('gaya_belajar')
                    ->label('Gaya Belajar')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'visual' => 'Visual',
                        'auditori' => 'Auditori',
                        'kinestetik' => 'Kinestetik',
                        'readwrite' => 'Read/Write',
                        default => $state,
                    }),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('urutan');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizJawabans::route('/'),
            'create' => Pages\CreateQuizJawaban::route('/create'),
            'edit' => Pages\EditQuizJawaban::route('/{record}/edit'),
        ];
    }
}
