<?php

namespace App\Filament\Resources\MinatSoalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class JawabanRelationManager extends RelationManager
{
    protected static string $relationship = 'jawaban';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->label('Kode (A/B/C/D)')
                    ->maxLength(1)
                    ->nullable(),
                TextInput::make('label')
                    ->label('Label Jawaban')
                    ->required(),
                TextInput::make('value')
                    ->label('Nilai Hasil (disimpan)')
                    ->required(),
                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('urutan')
            ->columns([
                TextColumn::make('kode')->label('Kode')->badge(),
                TextColumn::make('label')->label('Label')->limit(60)->wrap(),
                TextColumn::make('value')->label('Nilai')->badge(),
                TextColumn::make('urutan')->label('Urutan')->sortable(),
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