<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;

class GetPeminjaman extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Peminjaman', Peminjaman::select()->count()),
            Stat::make('Total Buku', Buku::select()->count()),
            Stat::make('Total Siswa', User::where('role', 'siswa')->count()),
        ];
    }
}
