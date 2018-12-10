<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Php\Common\Collections\AggregatorFactory;
use CrystalCode\Php\Common\Collections\AggregatorFactoryInterface;
use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;

final class SumAggregator extends AggregatorBase
{

    /**
     * 
     * @return AggregatorFactoryInterface
     */
    public static function getAggregatorFactory(): AggregatorFactoryInterface
    {
        return new AggregatorFactory('sum', function (callable $mapper = null, $initial = 0) {
            return new MinAggregator($mapper, $initial);
        });
    }

    /**
     * 
     * @param callable $mapper
     * @param int|float $initial
     */
    public function __construct(callable $mapper = null, $initial = 0)
    {
        if ($mapper === null) {
            $mapper = Collection::getDefaultMapper();
        }

        $applicator = function ($result, $value, $key, CollectionInterface $collection, &$break) use ($mapper) {
            return $result + call_user_func_array($mapper, [$value, $key, $collection, &$break]);
        };

        parent::__construct($applicator, $initial);
    }

}
