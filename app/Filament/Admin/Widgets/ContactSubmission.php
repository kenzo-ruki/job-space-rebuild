<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\ContactSubmission as ContactSubmissionModel;

class ContactSubmission extends BaseWidget
{

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                ContactSubmissionModel::query()
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
