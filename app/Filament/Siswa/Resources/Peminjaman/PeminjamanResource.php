<?php

namespace App\Filament\Siswa\Resources\Peminjaman;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Siswa\Resources\Peminjaman\Pages\CreatePeminjaman;
use App\Filament\Siswa\Resources\Peminjaman\Pages\EditPeminjaman;
use App\Filament\Siswa\Resources\Peminjaman\Pages\ListPeminjaman;
use App\Filament\Siswa\Resources\Peminjaman\Schemas\PeminjamanForm;
use App\Filament\Siswa\Resources\Peminjaman\Tables\PeminjamanTable;
use App\Models\Peminjaman;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationLabel(): string
    {
        return 'Peminjaman';
    }

    public static function getModelLabel(): string
    {
        return 'Peminjaman';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Peminjaman';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam');
    }

    public static function form(Schema $schema): Schema
    {
        return PeminjamanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeminjamanTable::configure($table);
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
            'index' => ListPeminjaman::route('/'),
            'create' => CreatePeminjaman::route('/create'),
            'edit' => EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
