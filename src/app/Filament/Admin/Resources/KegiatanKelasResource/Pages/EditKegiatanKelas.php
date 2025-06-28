<?php

namespace App\Filament\Admin\Resources\KegiatanKelasResource\Pages;

use App\Filament\Admin\Resources\KegiatanKelasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKegiatanKelas extends EditRecord
{
    protected static string $resource = KegiatanKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
