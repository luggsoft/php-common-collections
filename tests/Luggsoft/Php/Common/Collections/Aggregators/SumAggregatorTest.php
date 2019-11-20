<?php

namespace Luggsoft\Php\Common\Collections\Aggregators;

use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\Collector;
use PHPUnit\Framework\TestCase;

class SumAggregatorTest extends TestCase
{
    
    /**
     *
     * @return void
     */
    public function test1(): void
    {
        $expect = 15;
        $actual = Collection::create([1, 2, 3, 4, 5])
            ->aggregateWith(new SumAggregator);
        
        $this->assertEquals($expect, $actual);
    }
    
    /**
     *
     * @return void
     */
    public function test2(): void
    {
        $expect = 15;
        $actual = Collection::create([
            (object) ['value' => 1],
            (object) ['value' => 2],
            (object) ['value' => 3],
            (object) ['value' => 4],
            (object) ['value' => 5],
        ])
            ->aggregateWith(new SumAggregator(function ($object) {
                return $object->value;
            }));
        
        $this->assertEquals($expect, $actual);
    }
    
    /**
     *
     * @return void
     */
    public function test3(): void
    {
        $expect = 25;
        $actual = Collection::create([
            (object) ['value' => 1],
            (object) ['value' => 2],
            (object) ['value' => 3],
            (object) ['value' => 4],
            (object) ['value' => 5],
        ])
            ->aggregateWith(new SumAggregator(function ($object) {
                return $object->value;
            }, 10));
        
        $this->assertEquals($expect, $actual);
    }
    
    /**
     *
     * @return void
     */
    public function test4(): void
    {
        $expect = 15;
        $actual = Collector::create([1, 2, 3, 4, 5])->sum();
        
        $this->assertEquals($expect, $actual);
    }
    
    /**
     *
     * @return void
     */
    public function test5(): void
    {
        $expect = 15;
        $actual = Collector::create([
            (object) ['value' => 1],
            (object) ['value' => 2],
            (object) ['value' => 3],
            (object) ['value' => 4],
            (object) ['value' => 5],
        ])
            ->sum(function ($object) {
                return $object->value;
            });
        
        $this->assertEquals($expect, $actual);
    }
    
    /**
     *
     * @return void
     */
    public function test6(): void
    {
        $expect = 25;
        $actual = Collector::create([
            (object) ['value' => 1],
            (object) ['value' => 2],
            (object) ['value' => 3],
            (object) ['value' => 4],
            (object) ['value' => 5],
        ])
            ->sum(function ($object) {
                return $object->value;
            }, 10);
        
        $this->assertEquals($expect, $actual);
    }
    
}
