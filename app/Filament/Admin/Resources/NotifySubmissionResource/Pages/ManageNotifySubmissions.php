<?php

namespace App\Filament\Admin\Resources\NotifySubmissionResource\Pages;

use App\Filament\Admin\Resources\NotifySubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNotifySubmissions extends ManageRecords
{
    protected static string $resource = NotifySubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
