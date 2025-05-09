<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ecourse;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EcourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\EcourseResource\RelationManagers;

class EcourseResource extends Resource
{
    protected static ?string $model = Ecourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data Ecourse';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Ecourse')
                        ->placeholder('Nama Ecourse')
                        ->required(),
                    TextInput::make('price')
                        ->placeholder('Harga Ecourse')
                        ->required(),
                    TextInput::make('link')
                        ->label('link landingpage')
                        ->placeholder('ex : https://uiux.excellentcourse.id/')
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->label('Foto Ecourse')
                        ->collection('ecourse')
                        ->image()
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
                    ->label('Nama Ecourse')
                    ->wrap()
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga Ecourse')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('link')
                    ->alignCenter()
                    ->label('Link Landingpage')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto Ecourse')
                    ->alignCenter()
                    ->width(150)
                    ->height(150)
                    ->collection('ecourse'),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->alignCenter()
                    ->label('Dibuat')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Updated')
                            ->color('success')
                            ->body("Data E-course {$record->name} berhasil diubah!")
                            ->success()
                            ->duration(3000)
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record) {
                        Notification::make()
                            ->title('Deleted')
                            ->color('danger')
                            ->icon('heroicon-s-trash')
                            ->iconColor('danger')
                            ->body("Data E-course {$record->name} berhasil dihapus!")
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
            'index' => Pages\ManageEcourses::route('/'),
        ];
    }
}
