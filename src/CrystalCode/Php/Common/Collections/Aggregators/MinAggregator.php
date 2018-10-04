<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;

class MinAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $mapper
     */
    public function __construct(callable $mapper = null)
    {
        $min = null;
        $mapper = $mapper ?: Collection::getDefaultMapper();
        $applicator = function ($result, $value, $key, CollectionInterface $collection, &$break) use ($mapper, &$min) {
            $current = call_user_func_array($mapper, [$value, $key, $collection, &$break]);
            if ($min !== null) {
                if ($current > $min) {
                    return $result;
                }
            }
            $min = $current;
            return $value;
        };
        parent::__construct($applicator, null);
    }

}
