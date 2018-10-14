<?php

namespace CrystalCode\Php\Common\Collections;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{

    /**
     * 
     * @return void
     */
    public function testCreate()
    {
        $collection = Collection::create([]);
        $this->assertInstanceOf(Collection::class, $collection);

        $array = $collection->toArray();
        $this->assertEquals([], $array);
    }

    /**
     * 
     * @return void
     */
    public function testDeconstruct()
    {
        $function = function (...$values) {
            return count($values);
        };

        $collection = Collection::create([1, 2, 3]);
        $count = $function(...$collection);

        $this->assertEquals(3, $count);
    }

}
