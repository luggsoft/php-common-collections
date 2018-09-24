<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;

class MinAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $mapper
     */
    public function __construct(callable $mapper = null)
    {
        $min = 0;
        $mapper = $mapper ?: self::getDefaultValueMapper();
        $applicator = function ($result, $value, $key) use ($mapper, &$min) {
            $current = call_user_func($mapper, $value, $key);
            if ($current > $min) {
                return $result;
            }
            $min = $current;
            return $value;
        };
        parent::__construct($applicator, null);
    }

}
