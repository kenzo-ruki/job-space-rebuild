<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingsAdminResource\Pages;
use App\Filament\Admin\Resources\SettingsResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingsAdminResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    protected static ?string $navigationLabel = 'Developer Settings';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->formatStateUsing(function ($state) {
                        if ($state === '1') {
                            return 'True';
                        } else if ($state === '0') {
                            return 'False';
                        }
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form(function (Setting $record) {
                        return match ($record->type) {
                            'select' => [
                                Forms\Components\Select::make('value')
                                    ->label($record->label)
                                    ->options($record->attributes['options'])
                            ],
                            'number' => [
                                Forms\Components\TextInput::make('value')
                                    ->label($record->label)
                                    ->type('number')
                            ],
                            'boolean' => [
                                Forms\Components\Toggle::make('value')
                                    ->label($record->label)
                            ],
                            default => [
                                Forms\Components\TextInput::make('value')
                                    ->label($record->label)
                            ]
                        };
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettingsAdmins::route('/'),
        ];
    }
}
