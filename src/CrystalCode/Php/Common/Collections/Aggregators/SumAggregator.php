<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;

class SumAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $mapper
     * @param int|float $initial
     */
    public function __construct(callable $mapper = null, $initial = 0)
    {
        $mapper = $mapper ?: Collection::getDefaultMapper();
        $applicator = function ($result, $value, $key, CollectionInterface $collection, &$break) use ($mapper) {
            return $result + call_user_func_array($mapper, [$value, $key, $collection, &$break]);
        };
        parent::__construct($applicator, $initial);
    }

}
