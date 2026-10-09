<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('unit_id')
                    ->relationship('unit', 'name')
                    ->required(),
                TextInput::make('cost_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('selling_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Toggle::make('status')
                    ->required(),
            ]);
    }
}
