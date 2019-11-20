<?php

namespace Luggsoft\Php\Common\Collections;

use PHPUnit\Framework\TestCase;

class CollectorTest extends TestCase
{
    
    /**
     *
     * @return5 void
     */
    public function testCreate()
    {
        $max = Collector::max([1, 2, 3, 4, 5]);
        $this->assertEquals(5, $max);
        
        $max = Collector::max([5, 6, 7, 8, 9]);
        $this->assertEquals(9, $max);
        
        $max = Collector::max([3, 5, 1, 9, 7]);
        $this->assertEquals(9, $max);
        
        $max = Collector::max(function () {
            yield 1;
            yield 5;
            yield 3;
        });
        $this->assertEquals(5, $max);
    }
    
}
