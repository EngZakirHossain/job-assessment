<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class SaleService
{
    /**
     * createSale uses named arguments for clarity.
     */
    public function createSale(array $saleData, array $itemsData): Sale
    {
        return DB::transaction(function () use ($saleData, $itemsData) {

            $totals = calculateSaleTotal($itemsData);

            $sale = Sale::create(array_merge($saleData, [
                'subtotal' => $totals['subtotal'],
                'discount_total' => $totals['discount_total'],
                'grand_total' => $totals['grand_total'],
            ]));

            foreach ($itemsData as $it) {
                $lineTotal = round((int) $it['quantity'] * (float) $it['unit_price'] - (float) ($it['discount'] ?? 0), 2);
                $sale->items()->create([
                    'product_id' => $it['product_id'],
                    'quantity' => $it['quantity'],
                    'unit_price' => $it['unit_price'],
                    'discount' => $it['discount'] ?? 0,
                    'total' => $lineTotal,
                ]);
            }

            return $sale->load('items.product', 'customer');
        });
    }

    public function updateSale(Sale $sale, array $saleData, array $itemsData)
    {
        $sale->update($saleData);

        $existingItemIds = $sale->items()->pluck('id')->toArray();
        $submittedItemIds = collect($itemsData)->pluck('id')->filter()->toArray();

        $toDelete = array_diff($existingItemIds, $submittedItemIds);
        SaleItem::whereIn('id', $toDelete)->delete();

        foreach ($itemsData as $itemData) {
            if (! empty($itemData['id'])) {
                $saleItem = SaleItem::find($itemData['id']);
                $saleItem->update($itemData);
            } else {
                $sale->items()->create($itemData);
            }
        }

        return $sale->load('items.product', 'customer');
    }
}
