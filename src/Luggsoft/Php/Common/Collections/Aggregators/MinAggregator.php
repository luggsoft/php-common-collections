<?php

namespace Luggsoft\Php\Common\Collections\Aggregators;

use Luggsoft\Php\Common\Collections\AggregatorBase;
use Luggsoft\Php\Common\Collections\AggregatorFactory;
use Luggsoft\Php\Common\Collections\AggregatorFactoryInterface;
use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;

final class MinAggregator extends AggregatorBase
{
    
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
    
}
