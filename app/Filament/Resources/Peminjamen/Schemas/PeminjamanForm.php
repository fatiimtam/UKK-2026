<?php

namespace App\Filament\Resources\Peminjamen\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PeminjamanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('buku_id')
                    ->relationship('buku', 'judul')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                DateTimePicker::make('kapan_dipinjam')
                    ->required(),
                DateTimePicker::make('kapan_dikembalikan')
                    ->required(),
                Select::make('status')
                    ->options(['dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan'])
                    ->default('dipinjam')
                    ->required(),
            ]);
    }
}
