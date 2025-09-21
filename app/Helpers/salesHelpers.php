<?php

if (! function_exists('calculateSaleTotal')) {
    function calculateSaleTotal(array $items): array
    {
        $subtotal = 0.0;
        $discount_total = 0.0;

        foreach ($items as $item) {
            $qty = (int) ($item['quantity'] ?? 0);
            $unit = (float) ($item['unit_price'] ?? 0.0);
            $discount = (float) ($item['discount'] ?? 0.0);

            $lineSub = $qty * $unit;
            $lineDiscount = $discount;

            $subtotal += $lineSub;
            $discount_total += $lineDiscount;
        }

        $grand = $subtotal - $discount_total;
        $subtotal = round($subtotal, 2);
        $discount_total = round($discount_total, 2);
        $grand = round($grand, 2);

        return ['subtotal' => $subtotal, 'discount_total' => $discount_total, 'grand_total' => $grand];
    }
}
