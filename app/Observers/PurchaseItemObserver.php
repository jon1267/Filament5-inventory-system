<?php

namespace App\Observers;

use App\Models\PurchaseItem;
use App\Models\Stock;

class PurchaseItemObserver
{
    /**
     * Handle the PurchaseItem "created" event.
     */
    public function created(PurchaseItem $purchaseItem): void
    {
        $this->adjustStock($purchaseItem, $purchaseItem->quantity);
    }

    /**
     * Handle the PurchaseItem "updated" event.
     */
    public function updated(PurchaseItem $purchaseItem): void
    {
        if (! $purchaseItem->wasChanged('quantity')) {
            return;
        }

        $originalQuantity = $purchaseItem->getOriginal('quantity');
        $difference = $purchaseItem->quantity - $originalQuantity;

        $this->adjustStock($purchaseItem, $difference);
    }

    /**
     * Handle the PurchaseItem "deleted" event.
     */
    public function deleted(PurchaseItem $purchaseItem): void
    {
        $this->adjustStock($purchaseItem, -1 * $purchaseItem->quantity);
    }

    protected function adjustStock(PurchaseItem $purchaseItem, int $quantityChange): void
    {
        if ($quantityChange === 0) {
            return;
        }

        $warehouseId = $purchaseItem->purchase->warehouse_id;
        $stock = Stock::firstOrNew([
            'product_id' => $purchaseItem->product_id,
            'warehouse_id' => $warehouseId,
        ]);

        $stock->quantity = ($stock->quantity ?? 0) + $quantityChange;
        $stock->save();
    }

    /**
     * Handle the PurchaseItem "restored" event.
     */
    public function restored(PurchaseItem $purchaseItem): void
    {
        //
    }

    /**
     * Handle the PurchaseItem "force deleted" event.
     */
    public function forceDeleted(PurchaseItem $purchaseItem): void
    {
        //
    }
}
