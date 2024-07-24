<?php

namespace App\Filament\Admin\Resources\RateResource\Pages;

use App\Filament\Admin\Resources\RateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRates extends ManageRecords
{
    protected static string $resource = RateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
