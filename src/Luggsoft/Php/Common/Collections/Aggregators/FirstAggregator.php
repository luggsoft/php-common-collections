<?php

namespace Luggsoft\Php\Common\Collections\Aggregators;

use Luggsoft\Php\Common\Collections\AggregatorBase;
use Luggsoft\Php\Common\Collections\AggregatorFactory;
use Luggsoft\Php\Common\Collections\AggregatorFactoryInterface;
use Luggsoft\Php\Common\Collections\Collection;
use Luggsoft\Php\Common\Collections\CollectionInterface;

final class FirstAggregator extends AggregatorBase
{
    
    /**
     *
     * @param callable $predicate
     */
    public function __construct(callable $predicate = null)
    {
        if ($predicate === null) {
            $predicate = Collection::getDefaultPredicate();
        }
        
        $applicator = function ($result, $value, $key, CollectionInterface $collection, &$break) use ($predicate) {
            if ((bool) call_user_func_array($predicate, [$value, $key, $collection, &$break])) {
                $break = true;
                return $value;
            }
            
            return $result;
        };
        
        parent::__construct($applicator, null);
    }
    
    /**
     *
     * @return AggregatorFactoryInterface
     */
    public static function getAggregatorFactory(): AggregatorFactoryInterface
    {
        return new AggregatorFactory('first', function (callable $predicate = null) {
            return new FirstAggregator($predicate);
        });
    }
    
}
