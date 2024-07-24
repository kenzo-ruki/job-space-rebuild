<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Page as PageModel;

class Page extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                PageModel::query()
            )
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->sortable()
                    ->boolean(),
            ]);
    }
}
