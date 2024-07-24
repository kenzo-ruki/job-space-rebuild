<?php

namespace App\Filament\Admin\Resources\JobResource\Pages;

use App\Filament\Admin\Resources\JobResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditJob extends EditRecord
{
    protected static string $resource = JobResource::class;


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['job_type'] = explode(',', $data['job_type']);
     
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (is_array($data['job_type'])) {
            $data['job_type'] = implode(',', $data['job_type']);
        }
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
