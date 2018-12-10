<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class TakeEnumeratorTest extends TestCase
{

    public function testSimple()
    {
        t1: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new TakeEnumerator(2))
            ->toArray();

            $this->assertEquals($result, [1, 2]);
        }

        t2: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new TakeEnumerator(3))
            ->toArray();

            $this->assertEquals($result, [1, 2, 3]);
        }

        t3: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new TakeEnumerator(5))
            ->toArray();

            $this->assertEquals($result, [1, 2, 3, 4, 5]);
        }

        t4: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->enumerateWith(new TakeEnumerator(0))
            ->toArray();

            $this->assertEquals($result, []);
        }
    }

}
