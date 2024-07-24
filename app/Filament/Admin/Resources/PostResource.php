<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use RalphJSmit\Filament\SEO\SEO;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Grid::make(columns: 2)->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(2048)
                    ->reactive()
                    ->debounce(500)
                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                        if ($operation !== 'create') {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(2048),
                Forms\Components\Select::make('categories')
                    ->multiple()
                    ->relationship('categories', 'title'),
                Forms\Components\FileUpload::make('thumbnail'),
                TinyEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('published_at'),
                Forms\Components\Toggle::make('active'),
            ]),
            Forms\Components\Section::make('SEO')
                ->description('Configure SEO fields for this post.')
                ->schema([
                    SEO::make()
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
