<?php

namespace Luggsoft\Php\Common\Collections\Aggregators;

use Luggsoft\Php\Common\Collections\AggregatorBase;
use Luggsoft\Php\Common\Collections\AggregatorFactory;
use Luggsoft\Php\Common\Collections\AggregatorFactoryInterface;
use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;

final class SumAggregator extends AggregatorBase
{
    
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
        
        $applicator = function ($result, $value, $key, CollectionInterface $collection, bool &$break) use ($mapper) {
            return $result + call_user_func_array($mapper, [$value, $key, $collection, &$break]);
        };
        
        parent::__construct($applicator, $initial);
    }
    
    /**
     *
     * @return AggregatorFactoryInterface
     */
    public static function getAggregatorFactory(): AggregatorFactoryInterface
    {
        return new AggregatorFactory('sum', function (callable $mapper = null, $initial = 0) {
            return new SumAggregator($mapper, $initial);
        });
    }
    
}
