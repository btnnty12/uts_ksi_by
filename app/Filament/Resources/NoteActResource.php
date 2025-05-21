<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteActResource\Pages;
use App\Filament\Resources\NoteActResource\RelationManagers;
use App\Models\NoteAct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoteActResource extends Resource
{
    protected static ?string $model = NoteAct::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Sistem Pengelolaan';
    protected static ?string $navigationLabel = 'Log Aktivitas';
    protected static ?int $navigationSort = 2;

    public static function canCreate(): bool
    {
        return false; // Disable creation of activity logs
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Pengguna')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('action')
                    ->label('Aksi')
                    ->disabled()
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('table_name')
                    ->label('Tabel')
                    ->disabled()
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('record_id')
                    ->label('ID Record')
                    ->disabled()
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable(),
                Tables\Columns\TextColumn::make('action')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'create' => 'success',
                        'update' => 'warning',
                        'delete' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('table_name')
                    ->label('Tabel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('record_id')
                    ->label('ID Record')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal & Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Pengguna')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('action')
                    ->label('Aksi')
                    ->options([
                        'create' => 'Buat',
                        'update' => 'Perbarui',
                        'delete' => 'Hapus',
                        'bulk_delete' => 'Hapus Massal',
                    ]),
                Tables\Filters\SelectFilter::make('table_name')
                    ->label('Tabel')
                    ->options([
                        'users' => 'Pengguna',
                        'classes' => 'Kelas',
                        'students' => 'Siswa',
                    ]),
            ])
            ->actions([
                // No actions for now
            ])
            ->bulkActions([
                // No bulk actions for activity logs
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
            'index' => Pages\ListNoteActs::route('/'),
        ];
    }
}
