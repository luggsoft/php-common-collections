<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Php\Common\Collections\Enumerators\MapEnumerator;
use PHPUnit\Framework\TestCase;

class CollectizerTest extends TestCase
{

    /**
     * 
     * @return void
     */
    public function testDefaults()
    {
        Collectizer::registerEnumerator('map', function ($mapper) {
            return new MapEnumerator($mapper);
        });

        $collection = Collectizer::create([1, 2, 3, 4, 5])
        ->map(function ($value) {
            return $value * 13;
        })
        ->map(function ($value) {
            return $value - 1;
        })
        ->toCollection();

        $array = $collection->toArray();

        var_dump($array);
    }

}
