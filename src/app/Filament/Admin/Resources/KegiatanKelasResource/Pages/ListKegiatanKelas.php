<?php

namespace App\Filament\Admin\Resources\KegiatanKelasResource\Pages;

use App\Filament\Admin\Resources\KegiatanKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKegiatanKelas extends ListRecords
{
    protected static string $resource = KegiatanKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
