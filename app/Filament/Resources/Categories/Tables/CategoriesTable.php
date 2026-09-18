<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
// use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Columns\ImageColumn;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
            return $table
                ->columns([
                    ImageColumn::make('icon')
                        ->label('Icon')
                        ->disk('public')
                        ->circular()
                        ->height(50)
                        ->width(50)
                        ->stacked(),

                    TextColumn::make('name')
                        ->label('Category Name')
                        ->searchable()
                        ->sortable()
                        ->weight('bold')
                        ->description(fn ($record) => $record->slug),

                    TextColumn::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger'
                            }),

                    // TextColumn::make('products_count')
                        // ->label('Total Produk')
                        // ->counts('products')
                        // ->badge()
                        // ->color('info')
                        // ->sortable(),

                    TextColumn::make('created_at')
                        ->label('Created at')
                        ->dateTime('d M Y, H:i')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('updated_at')
                        ->label('Updated at')
                        ->dateTime('d M Y, H:i')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
                ->defaultSort('created_at', 'desc')
                ->filters([
                    // TernaryFilter::make('status')
                    //     ->label('Active Status')
                    //     ->trueLabel('Hanya Kategori Aktif')
                    //     ->falseLabel('Hanya Kategori Non-Aktif')
                    //     ->placeholder('Semua Status'),
                ])
                ->recordActions([
                    ViewAction::make(),
                    EditAction::make(),
                ])
                ->toolbarActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
                    ]),
            ]);
    }
}
