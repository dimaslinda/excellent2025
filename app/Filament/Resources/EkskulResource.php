<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ekskul;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EkskulResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\EkskulResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class EkskulResource extends Resource
{
    protected static ?string $model = Ekskul::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data Ekskul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Ekskul')
                        ->placeholder('Nama Ekskul')
                        ->autocapitalize('words')
                        ->live(debounce: 500)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->required(),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->placeholder('Slug')
                        ->unique(ignorable: fn($record) => $record)
                        ->readOnly()
                        ->required(),
                    RichEditor::make('deskripsi')
                        ->label('Deskripsi Ekskul')
                        ->toolbarButtons([])
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Foto Ekskul')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->collection('ekskul')
                        ->image()
                        ->directory('ekskul')
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->maxSize(10024)
                        ->hint('Ukuran Maksimal 10 MB')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintColor('warning')
                        ->required()
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Ekskul')
                    ->wrap()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->alignCenter()
                    ->label('Deskripsi Ekskul')
                    ->wrap()
                    ->limit(50)
                    ->html()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto Ekskul')
                    ->alignCenter()
                    ->width(100)
                    ->height(100)
                    ->collection('ekskul'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->successNotification(null)
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Updated')
                            ->color('success')
                            ->body("Data Ekskul {$record->name} berhasil diubah!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Updated')
                            ->color('success')
                            ->body("Data Ekskul {$record->name} berhasil diubah!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
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
            'index' => Pages\ManageEkskuls::route('/'),
        ];
    }
}
