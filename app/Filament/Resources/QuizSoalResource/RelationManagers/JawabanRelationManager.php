<?php

namespace App\Filament\Resources\QuizSoalResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class JawabanRelationManager extends RelationManager
{
    protected static string $relationship = 'jawaban';
    protected static ?string $recordTitleAttribute = 'jawaban';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                TextInput::make('urutan')
                    ->numeric()
                    ->label('Urutan')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('urutan')
            ->columns([
                TextColumn::make('jawaban')
                    ->label('Jawaban')
                    ->limit(80)
                    ->wrap(),
                TextColumn::make('gaya_belajar')
                    ->label('Gaya Belajar')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('urutan');
    }
}