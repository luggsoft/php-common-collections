<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\Enumerators\SkipEnumerator;
use PHPUnit\Framework\TestCase;

class SkipEnumeratorTest extends TestCase
{

    public function testSimple()
    {
        t1: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new SkipEnumerator(2))
            ->toArray();

            $this->assertEquals($result, [3, 4, 5]);
        }

        t2: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new SkipEnumerator(3))
            ->toArray();

            $this->assertEquals($result, [4, 5]);
        }

        t3: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new SkipEnumerator(5))
            ->toArray();

            $this->assertEquals($result, []);
        }

        t4: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new SkipEnumerator(0))
            ->toArray();

            $this->assertEquals($result, [1, 2, 3, 4, 5]);
        }
    }

}
