<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class FirstKeyAggregatorTest extends TestCase
{

    public function testSimple()
    {
        t1: {
            $result = Collection::create(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5])
            ->aggregateWith(new FirstKeyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertEquals('c', $result);
        }

        t2: {
            $result = Collection::create(['a' => 1, 'b' => 1, 'c' => 1, 'd' => 1, 'e' => 1])
            ->aggregateWith(new FirstKeyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertNull($result);
        }

        t3: {
            $result = Collection::create(['a' => 5, 'b' => 5, 'c' => 5, 'd' => 5, 'e' => 5])
            ->aggregateWith(new FirstKeyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertEquals('a', $result);
        }

        t4: {
            $result = Collection::create([])
            ->aggregateWith(new FirstKeyAggregator(function ($value) {
                return $value >= 3;
            }));

            $this->assertNull($result);
        }
    }

}
