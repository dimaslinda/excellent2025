<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Artikel';

    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Article')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Konten')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->placeholder('Masukkan judul artikel')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) =>
                                    $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->disabled()
                                    ->unique(ignoreRecord: true),

                                SpatieMediaLibraryFileUpload::make('thumbnail')
                                    ->collection('article')
                                    ->required()
                                    ->imageEditor()
                                    ->disk('gcs')
                                    ->label('Thumbnail')
                                    ->image()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->maxSize(10024)
                                    ->hint('Maksimal 10 MB')
                                    ->acceptedFileTypes(['image/png', 'image/jpg', 'image/jpeg', 'image/webp']),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Isi Artikel')
                                    ->placeholder('Tulis isi artikel di sini...')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'link',
                                        'bulletList',
                                        'orderedList',
                                    ])
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Pengaturan')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ])
                                    ->required(),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->nullable(),
                            ])->columns(2),

                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->placeholder('Masukkan meta title')
                                    ->maxLength(60)
                                    ->helperText('Optimal: 50-60 karakter'),

                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->placeholder('Masukkan meta description')
                                    ->maxLength(160)
                                    ->helperText('Optimal: 150-160 karakter'),

                                Forms\Components\TagsInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->placeholder('Tambahkan keyword')
                                    ->separator(',')
                                    ->helperText('Pisahkan dengan koma'),

                                Forms\Components\TextInput::make('canonical_url')
                                    ->label('Canonical URL')
                                    ->placeholder('Masukkan canonical URL')
                                    ->url(),

                                SpatieMediaLibraryFileUpload::make('og_image')
                                    ->collection('og-image')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('gcs')
                                    ->label('OG Image')
                                    ->helperText('Ukuran disarankan: 1200x600 pixel'),

                                SpatieMediaLibraryFileUpload::make('twitter_image')
                                    ->collection('twitter-image')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('gcs')
                                    ->label('Twitter Image')
                                    ->helperText('Ukuran disarankan: 1200x600 pixel'),
                            ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('article')
                    ->label('Thumbnail')
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil-square'),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
