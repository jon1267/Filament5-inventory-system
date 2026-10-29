<?php

namespace App\Observers;

use App\Models\SaleItem;
use App\Models\Stock;

class SaleItemObserver
{
    /**
     * Handle the SaleItem "created" event.
     */
    public function created(SaleItem $saleItem): void
    {
        $this->adjustStock($saleItem, -1 * $saleItem->quantity);
    }

    /**
     * Handle the SaleItem "updated" event.
     */
    public function updated(SaleItem $saleItem): void
    {
        if (! $saleItem->wasChanged('quantity')) {
            return;
        }

        $originalQuantity = $saleItem->getOriginal('quantity');
        $difference = $saleItem->quantity - $originalQuantity;
        $this->adjustStock($saleItem, -1 * $difference);
    }

    /**
     * Handle the SaleItem "deleted" event.
     */
    public function deleted(SaleItem $saleItem): void
    {
        $this->adjustStock($saleItem, $saleItem->quantity);
    }

    protected function adjustStock(SaleItem $saleItem, int $quantityChange): void
    {
        if ($quantityChange === 0) {
            return;
        }

        $warehouseId = $saleItem->sale->warehouse_id;

        $stock = Stock::firstOrNew([
            'product_id'   => $saleItem->product_id,
            'warehouse_id' => $warehouseId,
        ]);

        $stock->quantity = ($stock->quantity ?? 0) + $quantityChange;
        $stock->save();
    }

    /**
     * Handle the SaleItem "restored" event.
     */
    public function restored(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "force deleted" event.
     */
    public function forceDeleted(SaleItem $saleItem): void
    {
        //
    }
}
