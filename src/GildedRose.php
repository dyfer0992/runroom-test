<?php

namespace Runroom\GildedRose;

class GildedRose {
    /** @var array<Item>  */
    private array $items;

    /**
     * GildedRose constructor.
     * @param array<Item> $items
     */
    function __construct(array $items) {
        $this->items = $items;
    }

    function update_quality(): void {
        foreach ($this->items as $item) {
            if ($item->name == Item::FIXED_NAMES['SULFURA']) {
                continue;
            }

            $this->updateItemQuality($item);

            $item->sell_in--;

            if ($item->sell_in < 0) {
                $this->updateItemQuality($item);
            }
        }
    }

    protected function updateItemQuality(Item $item): void
    {
        if ($item->quality >= Item::MAX_QUALITY) {
            $item->quality = Item::MAX_QUALITY;
            return;
        }

        if (
            $item->name != Item::FIXED_NAMES['AGED']
            && $item->name != Item::FIXED_NAMES['BACKSTAGE']
            && $item->quality > 0
        ) {
            $item->quality--;
            return;
        }

        $item->quality++;

        if ($item->name == Item::FIXED_NAMES['BACKSTAGE']) {
            if ($item->sell_in < 0) {
                $item->quality -= $item->quality;
                return;
            }
            if ($item->sell_in < 6) {
                $item->quality += 2;
            } elseif ($item->sell_in < 11) {
                $item->quality++;
            }
        }
    }
}
