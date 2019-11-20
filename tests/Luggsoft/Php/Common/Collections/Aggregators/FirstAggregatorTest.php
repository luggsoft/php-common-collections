<?php

namespace Luggsoft\Php\Common\Collections\Aggregators;

use Luggsoft\Php\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class FirstAggregatorTest extends TestCase
{
    
    public function testSimple()
    {
        t1: {
        $result = Collection::create([1, 2, 3, 4, 5])
            ->aggregateWith(new FirstAggregator(function ($value) {
                return $value >= 3;
            }));
        
        $this->assertEquals(3, $result);
    }
        
        t2: {
        $result = Collection::create([1, 1, 1, 1, 1])
            ->aggregateWith(new FirstAggregator(function ($value) {
                return $value >= 3;
            }));
        
        $this->assertNull($result);
    }
        
        t3: {
        $result = Collection::create([5, 5, 5, 5, 5])
            ->aggregateWith(new FirstAggregator(function ($value) {
                return $value >= 3;
            }));
        
        $this->assertEquals(5, $result);
    }
        
        t4: {
        $result = Collection::create([])
            ->aggregateWith(new FirstAggregator(function ($value) {
                return $value >= 3;
            }));
        
        $this->assertNull($result);
    }
    }
    
}
