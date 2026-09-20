<?php

namespace App\Filament\Resources\Stores\Schemas;

use App\Models\Store;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class StoreInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Store Details')
                    ->tabs([
                        Tab::make('Store Detail')
                            ->icon(Heroicon::Tag)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Store Name')
                                    ->weight('bold'),

                                TextEntry::make('slug')
                                    ->label('Slug'),

                                TextEntry::make('description')
                                    ->label('Description')
                                    ->placeholder('-')
                                    ->columnSpanFull(),

                                ImageEntry::make('logo')
                                    ->label('Store Logo')
                                    ->circular()
                                    ->defaultImageUrl('https://picsum.photos/300/300'),

                                ImageEntry::make('banner')
                                    ->label('Store Banner')
                                    ->height(120)
                                    ->defaultImageUrl('https://picsum.photos/1200/400')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Tab::make('Owner Detail')
                            ->icon(Heroicon::UserCircle)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Owner Name')
                                    ->icon('heroicon-m-user'),

                                TextEntry::make('user.email')
                                    ->label('Owner Email')
                                    ->icon('heroicon-m-envelope'),

                                TextEntry::make('ktp_number')
                                    ->label('ID Card Number (NIK)')
                                    ->copyable()
                                    ->placeholder('-'),

                                ImageEntry::make('ktp_image')
                                    ->label('ID Card Photo')
                                    ->height(200)
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Tab::make('Validation Status')
                            ->icon(Heroicon::CheckBadge)
                            ->schema([
                                TextEntry::make('approval_status')
                                    ->label('Approval Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        'rejected' => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('status')
                                    ->label('Operational Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'active' => 'success',
                                        'suspended' => 'danger',
                                        default => 'gray',
                                    }),

                                IconEntry::make('is_verified')
                                    ->label('Verified Store')
                                    ->boolean(),

                                TextEntry::make('message')
                                    ->label('Message For Store Owner')
                                    ->placeholder('-')
                                    ->columnSpanFull(),

                                TextEntry::make('created_at')
                                    ->label('Registered At')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('-'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated At')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('-'),

                                TextEntry::make('deleted_at')
                                    ->label('Deleted At')
                                    ->dateTime('d M Y, H:i')
                                    ->visible(fn (Store $record): bool => $record->trashed()),
                            ])
                            ->columns(3),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
