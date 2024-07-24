<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use RalphJSmit\Filament\SEO\SEO;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Jobs';

    protected static ?string $navigationLabel = 'All Jobs';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([       
                Forms\Components\Grid::make(columns: 2)->schema([
                    Forms\Components\TextInput::make('job_title')
                        ->required()
                        ->columnSpanFull(),
                    TinyEditor::make('job_short_description')
                        ->columnSpanFull(),
                    TinyEditor::make('job_description')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('display_id'),
                    Forms\Components\TextInput::make('recruiter_id'),
                    Forms\Components\TextInput::make('job_source'),
                    Forms\Components\TextInput::make('job_reference'),
                ]),
                Forms\Components\Grid::make(columns: 3)->schema([
                    Forms\Components\Select::make('job_country_id')->relationship('country', titleAttribute: 'name'),
                    Forms\Components\Select::make('job_state_id')->relationship('zone', titleAttribute: 'zone_name'),
                    Forms\Components\Select::make('job_city_id')->relationship('city', titleAttribute: 'city_name'),
                    Forms\Components\TextInput::make('salary_from'),
                    Forms\Components\TextInput::make('salary_to'),
                    Forms\Components\TextInput::make('salary_description'),
                ]),
                Forms\Components\Grid::make(columns: 2)->schema([
                    Forms\Components\TextInput::make('job_type'),
                    Forms\Components\TextInput::make('job_vacancy_period'),
                    Forms\Components\Select::make('job_type')
                        ->options([
                            1 => 'Full-time',
                            2 => 'Part-time',
                            3 => 'Contract',
                            4 => 'Permanent',
                            5 => 'Temporary',
                        ])
                        ->multiple()
                        ->placeholder('Select Job Type'),
                    Forms\Components\TextInput::make('url'),
                    Forms\Components\TextInput::make('video_link'),
                    Forms\Components\Checkbox::make('job_featured'),
                    Forms\Components\Checkbox::make('job_auto_renew'),
                ]),
                Forms\Components\Grid::make(columns: 3)->schema([
                    Forms\Components\DateTimePicker::make('created_at')->disabled(),
                    Forms\Components\DateTimePicker::make('updated_at')->disabled(),
                    Forms\Components\DateTimePicker::make('deleted_at')->disabled(),
                    Forms\Components\Checkbox::make('unpublished'),
                    Forms\Components\Checkbox::make('re_adv'),
                    Forms\Components\Checkbox::make('expired'),
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
                Tables\Columns\TextColumn::make('job_id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\IconColumn::make('expired')
                    ->boolean(),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('job_location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('job_type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('job_status')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('job_featured')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
