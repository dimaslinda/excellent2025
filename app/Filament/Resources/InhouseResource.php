<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Inhouse;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InhouseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\InhouseResource\RelationManagers;

class InhouseResource extends Resource
{
    protected static ?string $model = Inhouse::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Layanan';

    protected static ?string $navigationLabel = 'Data Inhouse Training';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Inhouse Training')
                        ->placeholder('Nama Inhouse Training')
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
                        ->label('Deskripsi Inhouse Training')
                        ->toolbarButtons([])
                        ->required(),
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label('Foto Inhouse Training')
                        ->required()
                        ->imageEditor()
                        ->disk('gcs')
                        ->collection('inhouse')
                        ->image()
                        ->directory('inhouse')
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
                    Toggle::make('publish')
                        ->label('Publish')
                        ->onColor('success')
                        ->offColor('danger')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Inhouse Training')
                    ->wrap()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->alignCenter()
                    ->label('Deskripsi Inhouse Training')
                    ->wrap()
                    ->limit(50)
                    ->html()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto Inhouse Training')
                    ->alignCenter()
                    ->width(100)
                    ->height(100)
                    ->collection('inhouse'),
                ToggleColumn::make('publish')
                    ->label('Publish')
                    ->onColor('success')
                    ->offColor('danger')
                    ->alignCenter()
                    ->action(function ($record, $state) {
                        $record->publish = $state;
                        $record->save();
                    })
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
                            ->body("Data Inhouse {$record->name} berhasil diubah!")
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
                            ->body("Data Inhouse {$record->name} berhasil diubah!")
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
            'index' => Pages\ManageInhouses::route('/'),
        ];
    }
}
