<?php

namespace App\Filament\Resources\CasetaResource\Pages;

use App\Filament\Resources\CasetaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaseta extends EditRecord
{
    protected static string $resource = CasetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
