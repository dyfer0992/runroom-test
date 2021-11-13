<?php

namespace Runroom\GildedRose;

class Item {
    const FIXED_NAMES = [
        'AGED'      => 'Aged Brie',
        'BACKSTAGE' => 'Backstage passes to a TAFKAL80ETC concert',
        'SULFURA'   => 'Sulfuras, Hand of Ragnaros',
    ];

    const MAX_QUALITY = 50;

    public string $name;
    public int $sell_in;
    public int $quality;

    function __construct(string $name, int $sell_in, int $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}
