<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class AllAggregatorTest extends TestCase
{

    /**
     * 
     * @return void
     */
    public function test1(): void
    {
        $result = Collection::create([1, 2, 3, 4, 5])
          ->aggregateWith(new AllAggregator(function ($value) {
              return $value >= 3;
          }));

        $this->assertFalse($result);
    }

    /**
     * 
     * @return void
     */
    public function test2(): void
    {
        $result = Collection::create([1, 1, 1, 1, 1])
          ->aggregateWith(new AllAggregator(function ($value) {
              return $value >= 3;
          }));

        $this->assertFalse($result);
    }

    /**
     * 
     * @return void
     */
    public function test3(): void
    {
        $result = Collection::create([5, 5, 5, 5, 5])
          ->aggregateWith(new AllAggregator(function ($value) {
              return $value >= 3;
          }));

        $this->assertTrue($result);
    }

    /**
     * 
     * @return void
     */
    public function test4(): void
    {
        $result = Collection::create([])
          ->aggregateWith(new AllAggregator(function ($value) {
              return $value >= 3;
          }));

        $this->assertTrue($result);
    }

}
