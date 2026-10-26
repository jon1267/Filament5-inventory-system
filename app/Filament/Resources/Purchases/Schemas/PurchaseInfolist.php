<?php

namespace App\Filament\Resources\Purchases\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PurchaseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Purchase Information')
                    ->schema([
                        TextEntry::make('invoice_no')
                            ->label('Invoice Number')
                            ->weight('bold'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'comleted' => 'success',
                            }),

                        TextEntry::make('supplier.name')
                            ->label('Supplier'),

                        TextEntry::make('warehouse.name')
                            ->label('Warehouse'),

                        TextEntry::make('purchase_date')
                            ->label('Purchase Date')
                            ->date('d M Y'),

                        TextEntry::make('total_amount')
                            ->label('Total Amount')
                            ->money('USD'),

                        TextEntry::make('paid_amount')
                            ->label('Paid Amount')
                            ->money('USD'),

                        TextEntry::make('due_amount')
                            ->label('Due Amount')
                            ->money('USD')
                            ->color(fn ($state) => $state > 0 ? 'danger' : 'success'),
                    ])
                    ->columns(3),

                Section::make('Purchase Items')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                TextEntry::make('product.name')
                                    ->label('Product')
                                    ->weight('bold')
                                    ->columnSpan(2),

                                TextEntry::make('quantity')
                                    ->label('Quantity'),

                                TextEntry::make('unit_cost')
                                    ->label('Unit Cost')
                                    ->money('USD'),

                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('USD')
                                    ->weight('bold'),
                            ])
                            ->columns(5)
                            ->contained(false),
                    ])
                    ->columns(1),
            ]);
    }
}
