<?php

namespace App\Filament\Resources\Warehouses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Warehouse Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Warehouse Name')
                            ->placeholder('e.g. Main Warehouse')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('location')
                            ->label('Location')
                            ->placeholder('e.g. Sector 12, Amsterdart, HavyCargo')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Toggle::make('status')
                            ->label('Active Status')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
            ]);
    }
}
