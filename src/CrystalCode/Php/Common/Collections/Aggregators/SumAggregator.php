<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;

class SumAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $mapper
     * @param int|float $initial
     */
    public function __construct(callable $mapper = null, $initial = 0)
    {
        $mapper = $mapper ?: self::getDefaultValueMapper();
        $applicator = function ($result, $value, $key) use ($mapper) {
            return $result + call_user_func($mapper, $value, $key);
        };
        parent::__construct($applicator, $initial);
    }

}
