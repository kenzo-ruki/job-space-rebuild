<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TestimonialResource\Pages;
use App\Filament\Admin\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(columns: 3)->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('company')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('position')
                        ->maxLength(255),
                ]),
                Forms\Components\FileUpload::make('company_photo_path'),
                Forms\Components\Textarea::make('testimonial')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ManageTestimonials::route('/'),
        ];
    }
}
