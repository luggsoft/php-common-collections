<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\Enumerators\SkipEnumerator;
use PHPUnit\Framework\TestCase;

class SkipEnumeratorTest extends TestCase
{

    /**
     * 
     * @return void
     */
    function testSkipEnumerator1(): void
    {
        $result = Collection::create([1, 2, 3, 4, 5])
          ->enumerateWith(new SkipEnumerator(2))
          ->toArray();

        $this->assertEquals($result, [2 => 3, 3 => 4, 4 => 5]);
    }

    /**
     * 
     * @return void
     */
    function testSkipEnumerator2(): void
    {
        $result = Collection::create([1, 2, 3, 4, 5])
          ->enumerateWith(new SkipEnumerator(3))
          ->toArray();

        $this->assertEquals($result, [3 => 4, 4 => 5]);
    }

    /**
     * 
     * @return void
     */
    function testSkipEnumerator3(): void
    {
        $result = Collection::create([1, 2, 3, 4, 5])
          ->enumerateWith(new SkipEnumerator(5))
          ->toArray();

        $this->assertEquals($result, []);
    }

    /**
     * 
     * @return void
     */
    function testSkipEnumerator4(): void
    {
        $result = Collection::create([1, 2, 3, 4, 5])
          ->enumerateWith(new SkipEnumerator(0))
          ->toArray();

        $this->assertEquals($result, [1, 2, 3, 4, 5]);
    }

}
