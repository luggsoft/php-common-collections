<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AnyAggregatorTest extends TestCase
{

    public function testSimple()
    {
        t1: {
            $result = Collection::create([1, 2, 3, 4, 5])
            ->aggregateWith(new AnyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertTrue($result);
        }

        t2: {
            $result = Collection::create([1, 1, 1, 1, 1])
            ->aggregateWith(new AnyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertFalse($result);
        }

        t3: {
            $result = Collection::create([5, 5, 5, 5, 5])
            ->aggregateWith(new AnyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertTrue($result);
        }

        t4: {
            $result = Collection::create([])
            ->aggregateWith(new AnyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertFalse($result);
        }
    }

}
