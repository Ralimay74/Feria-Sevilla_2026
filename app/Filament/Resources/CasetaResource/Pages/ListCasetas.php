<?php

namespace App\Filament\Resources\CasetaResource\Pages;

use App\Filament\Resources\CasetaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCasetas extends ListRecords
{
    protected static string $resource = CasetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
