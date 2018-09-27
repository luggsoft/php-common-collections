<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Php\Common\Collections\CollectionInterface;

final class FirstAggregator extends AggregatorBase
{

    /**
     * 
     * @param callable $predicate
     */
    public function __construct(callable $predicate)
    {
        $applicator = function ($result, $value, $key, CollectionInterface $collection, &$break) use ($predicate) {
            if ($result === null) {
                if ((bool) call_user_func_array($predicate, [$value, $key, $collection, &$break])) {
                    return $value;
                }
            }
            return $result;
        };
        parent::__construct($applicator, null);
    }

}
