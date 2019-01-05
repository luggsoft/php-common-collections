<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Php\Common\Collections\Aggregators\AllAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\AnyAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\FirstAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\FirstKeyAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\LastAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\LastKeyAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\MaxAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\MinAggregator;
use CrystalCode\Php\Common\Collections\Aggregators\SumAggregator;
use CrystalCode\Php\Common\Collections\Enumerators\FilterEnumerator;
use CrystalCode\Php\Common\Collections\Enumerators\MapEnumerator;
use CrystalCode\Php\Common\Collections\Enumerators\MapKeysEnumerator;
use CrystalCode\Php\Common\Collections\Enumerators\OrderEnumerator;
use CrystalCode\Php\Common\Collections\Enumerators\SkipEnumerator;
use CrystalCode\Php\Common\Collections\Enumerators\TakeEnumerator;
use CrystalCode\Php\Common\OperationException;

final class Collector extends CollectorBase
{

    /**
     * 
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $value = array_shift($arguments);
        return static::create($value)->apply($name, ...$arguments);
    }

    /**
     * 
     * @param mixed $min
     * @param mixed $max
     * @param mixed $step
     * @return Collector
     */
    public static function range($min = 0, $max = PHP_INT_MAX, $step = 1): Collector
    {
        $collection = Collection::range($min, $max, $step);
        return new Collector($collection);
    }

    /**
     * 
     * @param mixed $value
     * @return Collector
     */
    public static function create($value): Collector
    {
        $collection = Collection::create($value);
        return new Collector($collection);
    }

    /**
     * 
     * {@inheritdoc}
     * @throws OperationException
     */
    public function apply(string $name, ...$arguments)
    {
        if (self::hasAggregatorFactory($name)) {
            $aggregator = self::getAggregatorFactory($name)->createAggregator(...$arguments);
            return $this->getCollection()->aggregateWith($aggregator);
        }

        if (self::hasEnumeratorFactory($name)) {
            $enumerator = self::getEnumeratorFactory($name)->createEnumerator(...$arguments);
            $collection = $this->getCollection()->enumerateWith($enumerator);
            return new Collector($collection);
        }

        $message = vsprintf('The method "%s" is not registered', [
            $name,
        ]);
        throw new OperationException($name, $message);
    }

}

function Collector__init()
{
    static $initialize = true;

    if ($initialize) {
        Collector::addAggregatorFactory(AllAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(AnyAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(FirstAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(FirstKeyAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(LastAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(LastKeyAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(MaxAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(MinAggregator::getAggregatorFactory());
        Collector::addAggregatorFactory(SumAggregator::getAggregatorFactory());
        Collector::addEnumeratorFactory(FilterEnumerator::getEnumeratorFactory());
        Collector::addEnumeratorFactory(MapEnumerator::getEnumeratorFactory());
        Collector::addEnumeratorFactory(MapKeysEnumerator::getEnumeratorFactory());
        Collector::addEnumeratorFactory(OrderEnumerator::getEnumeratorFactory());
        Collector::addEnumeratorFactory(SkipEnumerator::getEnumeratorFactory());
        Collector::addEnumeratorFactory(TakeEnumerator::getEnumeratorFactory());
        $initialize = false;
    }
}

Collector__init();
