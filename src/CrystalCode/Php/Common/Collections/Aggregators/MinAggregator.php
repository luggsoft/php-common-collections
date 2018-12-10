<?php

namespace CrystalCode\Php\Common\Collections\Aggregators;

use CrystalCode\Php\Common\Collections\AggregatorBase;
use CrystalCode\Php\Common\Collections\AggregatorFactory;
use CrystalCode\Php\Common\Collections\AggregatorFactoryInterface;
use CrystalCode\Php\Common\Collections\Collection;
use CrystalCode\Php\Common\Collections\CollectionInterface;

final class MinAggregator extends AggregatorBase
{

    /**
     * 
     * @return AggregatorFactoryInterface
     */
    public static function getAggregatorFactory(): AggregatorFactoryInterface
    {
        return new AggregatorFactory('min', function (callable $mapper = null) {
            return new MinAggregator($mapper);
        });
    }

    /**
     * 
     * @param callable $mapper
     */
    public function __construct(callable $mapper = null)
    {
        if ($mapper === null) {
            $mapper = Collection::getDefaultMapper();
        }

        $min = null;

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
