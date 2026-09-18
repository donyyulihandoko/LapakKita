<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Details Category')
                    ->icon('heroicon-o-tag')
                ->description('Details of the category.')
                ->columnSpanFull()
                ->columns([
                    'sm' => 1,
                    'lg' => 2,
                ])
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('slug'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger'
                            }),
                        TextEntry::make('description')
                            ->placeholder('-'),
                        ImageEntry::make('icon')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                            ])
            ]);
    }
}
