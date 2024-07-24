<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RateResource\Pages;
use App\Filament\Admin\Resources\RateResource\RelationManagers;
use App\Models\Rate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RateResource extends Resource
{
    protected static ?string $model = Rate::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //            
                Forms\Components\Grid::make(columns: 2)->schema([
                    Forms\Components\TextInput::make('plan_type_name')
                        ->required()
                        ->label('Plan Type Name')
                        ->maxLength(2048)
                        ->reactive()
                        ->debounce(500)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation !== 'create' && $operation !== 'edit') {
                                return;
                            }
                            $set('slug', Str::slug($state));
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(2048),
                    Forms\Components\TextInput::make('time_period_months')
                        ->required()
                        ->numeric()
                        ->label('Time Period (Months)'),
                    Forms\Components\TextInput::make('fee')
                        ->required()
                        ->numeric()
                        ->label('Fee'),
                    Forms\Components\TextInput::make('number_of_postable_jobs')
                        ->required()
                        ->numeric()
                        ->label('Number of Postable Jobs'),
                    Forms\Components\TextInput::make('priority')
                        ->required()
                        ->numeric()
                        ->label('Priority'),
                    Forms\Components\Checkbox::make('jobs_show_as_featured')
                        ->label('Jobs Show as Featured'),
                    Forms\Components\Checkbox::make('search_cvs')
                        ->label('Search CVs'),
                    Forms\Components\RichEditor::make('plan_description')
                        ->required()
                        ->columnSpanFull()
                        ->label('Plan Description'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('plan_type_name')
                    ->label('Plan Type Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_period_months')
                    ->label('Time Period (Months)')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fee')
                    ->label('Fee')
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_postable_jobs')
                    ->label('Number of Postable Jobs')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('jobs_show_as_featured')
                    ->label('Jobs Show as Featured')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('search_cvs')
                    ->label('Search CVs')
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
            'index' => Pages\ManageRates::route('/'),
        ];
    }
}
