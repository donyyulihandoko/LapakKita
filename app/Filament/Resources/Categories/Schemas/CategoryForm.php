<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Create Category')
                    ->description('Enter the details of the category')
                    ->icon('heroicon-o-tag')
                    ->columns(2)
                    // ->aside()
                    ->columnSpan(2)
                    ->schema([

                        // input name
                        TextInput::make('name')
                            ->label('Category Name')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        // Input Slug
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->dehydrated()
                            ->disabled(),

                        // Input Status
                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive'
                            ])
                            ->default('active'),

                        // Input Icon
                        FileUpload::make('icon')
                            ->image()
                            ->disk('public') // Menyimpan file ke storage/app/public
                            ->directory('categories/icon') // Menyimpan di subfolder storage/app/public/crews/photos
                            ->visibility('public')
                            ->required()
                        ,

                        // Input Description
                        Textarea::make('description')
                            ->columnSpanFull(),

                ])

            ]);
    }
}
