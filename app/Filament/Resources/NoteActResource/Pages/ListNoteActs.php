<?php

namespace App\Filament\Resources\NoteActResource\Pages;

use App\Filament\Resources\NoteActResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNoteActs extends ListRecords
{
    protected static string $resource = NoteActResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
