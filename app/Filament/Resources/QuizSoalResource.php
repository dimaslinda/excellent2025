<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizSoalResource\Pages;
use App\Filament\Resources\QuizSoalResource\RelationManagers;
use App\Models\QuizSoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizSoalResource extends Resource
{
    protected static ?string $model = QuizSoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Quiz Gaya Belajar';

    protected static ?string $modelLabel = 'Soal Quiz';

    protected static ?string $pluralModelLabel = 'Soal-soal Quiz';

    protected static ?string $navigationGroup = 'Manajemen Soal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
                Forms\Components\Section::make('Jawaban')
                    ->description('Setiap jawaban akan mengarah ke salah satu gaya belajar')
                    ->schema([
                        Forms\Components\Repeater::make('jawaban')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('jawaban')
                                    ->label('Jawaban')
                                    ->required(),
                                Forms\Components\Select::make('gaya_belajar')
                                    ->label('Gaya Belajar')
                                    ->options([
                                        'visual' => 'Visual (Belajar dengan melihat)',
                                        'auditori' => 'Auditori (Belajar dengan mendengar)',
                                        'kinestetik' => 'Kinestetik (Belajar dengan bergerak)',
                                        'readwrite' => 'Read/Write (Belajar dengan membaca/menulis)',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('urutan')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(3)
                            ->minItems(2)
                            ->maxItems(4)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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
