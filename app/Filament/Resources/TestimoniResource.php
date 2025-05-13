<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Testimoni;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TestimoniResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\TestimoniResource\RelationManagers;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;

class TestimoniResource extends Resource
{
    protected static ?string $model = Testimoni::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    protected static ?string $navigationLabel = 'Data Testimoni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama')
                        ->placeholder('Nama')
                        ->required(),
                    TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->placeholder('Jabatan')
                        ->required(),
                    RichEditor::make('testimoni')
                        ->label('Testimoni')
                        ->placeholder('Testimoni')
                        ->toolbarButtons([])
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Foto Profile')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->collection('testimoni')
                        ->image()
                        ->directory('testimoni')
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->maxSize(10024)
                        ->hint('Ukuran Maksimal 10 MB')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintColor('warning')
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),
                    SpatieMediaLibraryFileUpload::make('thumb')
                        ->label('Thumbnail')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->collection('testimonithumb')
                        ->image()
                        ->directory('testimonithumb')
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->maxSize(10024)
                        ->hint('Ukuran Maksimal 10 MB')
                        ->hintIcon('heroicon-o-information-circle')
                        ->hintColor('warning')
                        ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->wrap()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('testimoni')
                    ->label('Testimoni')
                    ->wrap()
                    ->alignCenter()
                    ->html()
                    ->limit(50),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto Profile')
                    ->alignCenter()
                    ->width(100)
                    ->circular()
                    ->height(100)
                    ->collection('testimoni'),
                SpatieMediaLibraryImageColumn::make('thumb')
                    ->label('Thumbnail')
                    ->alignCenter()
                    ->width(100)
                    ->height(100)
                    ->collection('testimonithumb'),

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
                            ->body("Data Testimoni {$record->name} berhasil diubah!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Deleted')
                            ->color('danger')
                            ->icon('heroicon-s-trash')
                            ->iconColor('danger')
                            ->body("Data Testimoni {$record->name} berhasil dihapus!")
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
            'index' => Pages\ManageTestimonis::route('/'),
        ];
    }
}
