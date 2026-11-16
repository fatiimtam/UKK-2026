<?php

namespace App\Filament\Siswa\Resources\Peminjaman\Tables;

use App\Models\Peminjaman;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PeminjamanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('buku_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kapan_dipinjam')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('kapan_dikembalikan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('kembalikan')
                    ->label('Kembalikan Buku')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Pengembalian')
                    ->modalDescription('Apakah Anda yakin ingin mengembalikan buku ini sekarang?')
                    ->visible(fn (Peminjaman $record): bool => $record->status === 'dipinjam')
                    ->action(function (Peminjaman $record) {
                        $record->update([
                            'status' => 'dikembalikan',
                            'kapan_dikembalikan' => now(),
                        ]);

                        Notification::make()
                            ->title('Buku berhasil dikembalikan!')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
