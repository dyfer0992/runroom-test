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

            if ($item->name != Item::FIXED_NAMES['AGED'] and $item->name != Item::FIXED_NAMES['BACKSTAGE']) {
                if ($item->quality > 0) {
                    $item->quality = $item->quality - 1;
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == Item::FIXED_NAMES['BACKSTAGE']) {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            $item->sell_in = $item->sell_in - 1;

            if ($item->sell_in < 0) {
                if ($item->name != Item::FIXED_NAMES['AGED']) {
                    if ($item->name != Item::FIXED_NAMES['BACKSTAGE']) {
                        if ($item->quality > 0) {
                            $item->quality = $item->quality - 1;
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
