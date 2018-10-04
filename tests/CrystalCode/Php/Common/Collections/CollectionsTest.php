<?php

namespace CrystalCode\Php\Common\Collections;

use \PHPUnit\Framework\TestCase;

class CollectionsTest extends TestCase
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

}
