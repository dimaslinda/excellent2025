<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebinarResource\Pages;
use App\Filament\Resources\WebinarResource\RelationManagers;
use App\Models\Webinar;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebinarResource extends Resource
{
    protected static ?string $model = Webinar::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data Webinar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Webinar')
                        ->placeholder('Nama Webinar')
                        ->required(),
                    TextInput::make('link')
                        ->label('Link Gform')
                        ->placeholder('Link Gform')
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Foto Webinar')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->collection('webinar')
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
                    Toggle::make('publish')
                        ->label('Publish')
                        ->onColor('success')
                        ->offColor('danger')
                        ->inline()
                        ->default(false),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Webinar')
                    ->wrap()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('link')
                    ->alignCenter()
                    ->label('Link Gform'),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto Webinar')
                    ->alignCenter()
                    ->width(150)
                    ->height(150)
                    ->collection('webinar'),
                ToggleColumn::make('publish')
                    ->label('Publish')
                    ->onColor('success')
                    ->offColor('danger')
                    ->alignCenter()
                    ->action(function ($record, $state) {
                        $record->publish = $state;
                        $record->save();
                    }),
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
            'index' => Pages\ManageWebinars::route('/'),
        ];
    }
}
