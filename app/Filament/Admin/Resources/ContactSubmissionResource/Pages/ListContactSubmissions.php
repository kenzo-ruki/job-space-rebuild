<?php

namespace App\Filament\Admin\Resources\ContactSubmissionResource\Pages;

use App\Filament\Admin\Resources\ContactSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactSubmissions extends ListRecords
{
    protected static string $resource = ContactSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
