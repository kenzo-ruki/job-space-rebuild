<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms\Set;
use App\Filament\Admin\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use RalphJSmit\Filament\SEO\SEO;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

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
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            $set('slug', Str::slug($state));
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(2048),
                ]),
                TinyEditor::make('body')
                    ->columnSpanFull(),
                Forms\Components\Grid::make(columns: 3)->schema([
                    Forms\Components\FileUpload::make('thumbnail'),
                    Forms\Components\Toggle::make('layout'),
                    Forms\Components\Toggle::make('active')
                ]),
                Forms\Components\Section::make('SEO')
                    ->description('Configure SEO fields for this page.')
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
