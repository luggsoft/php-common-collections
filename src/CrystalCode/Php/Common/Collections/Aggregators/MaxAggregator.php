<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;

class MaxAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $mapper
     */
    public function __construct(callable $mapper = null)
    {
        $max = null;
        $mapper = $mapper ?: Collection::getDefaultMapper();
        $applicator = function ($result, $value, $key, CollectionInterface $collection, &$break) use ($mapper, &$max) {
            $current = call_user_func_array($mapper, [$value, $key, $collection, &$break]);
            if ($max !== null) {
                if ($current < $max) {
                    return $result;
                }
            }
            $max = $current;
            return $value;
        };
        parent::__construct($applicator, null);
    }

}
