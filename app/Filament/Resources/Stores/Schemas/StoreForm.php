<?php

namespace App\Filament\Resources\Stores\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class StoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Store Validation')
                    ->columnSpanFull()
                    // ->icon('heroicon-o-tag')
                    ->tabs([

                        // Store Detail
                        Tab::make('Store Detail')
                            ->icon(Heroicon::Tag)
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Store Name')
                                    ->required()
                                    ->dehydrated()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->disabled(),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->dehydrated()
                                    ->disabled()
                                    ->unique(ignoreRecord: true)
                                    ,
                                Textarea::make('description')
                                    ->label('Description')
                                    ->columnSpanFull()
                                    ->dehydrated()
                                    ->disabled(),
                                FileUpload::make('logo')
                                    ->label('Store Logo')
                                    ->dehydrated()
                                    ->disabled()
                                    ->image(),
                                FileUpload::make('banner')
                                    ->label('Store Banner')
                                    ->dehydrated()
                                    ->disabled()
                                    ->image(),
                            ]),

                        // Owner Detail
                        Tab::make('Owner Detail')
                            ->icon(Heroicon::UserCircle)
                            ->columns(2)
                            ->schema([
                                Select::make('user_id')
                                    ->label('Owner Name')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->dehydrated()
                                    ->disabled(),
                                TextInput::make('ktp_number')
                                    ->label('ID Card Number (NIK)')
                                    ->dehydrated()
                                    ->disabled(),
                                FileUpload::make('ktp_image')
                                    ->label('ID Card Photo')
                                    ->dehydrated()
                                    ->disabled()
                                    ->image()
                                    ->columnSpanFull(),

                            ]),

                        // Validation
                        Tab::make('Validation')
                            ->icon(Heroicon::CheckBadge)
                            ->columns(2)
                            ->schema([
                                Select::make('approval_status')
                                    ->label('Approval Status')
                                    ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                                    ->default('pending')
                                    ->required(),
                                Textarea::make('message')
                                    ->label('Message For Store Owner')
                                    ->columnSpanFull(),
                                Select::make('status')
                                    ->label('Operational Status')
                                    ->options(['active' => 'Active', 'suspended' => 'Suspended'])
                                    ->default('active')
                                    ->required(),
                                Toggle::make('is_verified')
                                    ->label('Verified Store')
                                    ->required(),
                            ])
                    ])
            ]);
    }
}
