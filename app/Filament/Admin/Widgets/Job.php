<?php

namespace App\Filament\Admin\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Job as JobModel;

class Job extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                JobModel::query()->orderBy('created_at', 'desc')
            )
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('job_id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('job_location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('job_type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('expired')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('job_featured')
                    ->boolean(),
            ]);
    }
}
