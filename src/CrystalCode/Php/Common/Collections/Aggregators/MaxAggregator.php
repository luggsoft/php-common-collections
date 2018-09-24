<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Common\Debug\Trace;

class MaxAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $mapper
     */
    public function __construct(callable $mapper = null)
    {
        $max = 0;
        $mapper = $mapper ?: self::getDefaultValueMapper();
        $applicator = function ($result, $value, $key) use ($mapper, &$max) {
            $current = call_user_func($mapper, $value, $key);
            if ($current < $max) {
                return $result;
            }
            $max = $current;
            return $value;
        };
        parent::__construct($applicator, null);
    }

}
