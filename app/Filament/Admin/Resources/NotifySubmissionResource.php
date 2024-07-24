<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NotifySubmissionResource\Pages;
use App\Filament\Admin\Resources\NotifySubmissionResource\RelationManagers;
use App\Models\NotifySubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class NotifySubmissionResource extends Resource
{
    protected static ?string $model = NotifySubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Grid::make(columns: 2)->schema([
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('frequency')
                        ->options([
                            'daily' => 'Daily',
                            'weekly' => 'Weekly', 
                            'monthly' => 'Monthly',
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('frequency'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ExportBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNotifySubmissions::route('/'),
        ];
    }
}
