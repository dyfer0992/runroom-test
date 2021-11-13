<?php

namespace Runroom\GildedRose;

class GildedRose {

    private array $items;

    function __construct(array $items) {
        $this->items = $items;
    }

    function update_quality(): void {
        foreach ($this->items as $item) {

            if ($item->name == Item::FIXED_NAMES['SULFURA']) {
                continue;
            }

            $this->updateItemQuality($item);

            if ($item->name == Item::FIXED_NAMES['AGED'] || $item->name == Item::FIXED_NAMES['BACKSTAGE']) {
                if ($item->quality < Item::MAX_QUALITY) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == Item::FIXED_NAMES['BACKSTAGE']) {
                        if ($item->sell_in < 11) {
                            if ($item->quality < Item::MAX_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < Item::MAX_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            $item->sell_in = $item->sell_in - 1;

            if ($item->sell_in < 0) {

                $this->updateItemQuality($item);

                if ($item->name != Item::FIXED_NAMES['AGED']) {
                    if ($item->name == Item::FIXED_NAMES['BACKSTAGE']) {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < Item::MAX_QUALITY) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }

    protected function updateItemQuality(Item $item): void
    {
        if (
            $item->name != Item::FIXED_NAMES['AGED']
            && $item->name != Item::FIXED_NAMES['BACKSTAGE']
            && $item->quality > 0
        ) {
            $item->quality--;
        }
    }
}
