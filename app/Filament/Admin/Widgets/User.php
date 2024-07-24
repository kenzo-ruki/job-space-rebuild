<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\User as UserModel;

class User extends BaseWidget
{

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                UserModel::query()
            )
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')                
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
            ]);
    }
}
