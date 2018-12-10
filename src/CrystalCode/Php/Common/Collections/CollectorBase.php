<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Php\Common\OperationException;

abstract class CollectorBase implements CollectorInterface
{

    /**
     *
     * @var array|AggregatorFactoryInterface[]
     */
    private static $aggregatorFactories = [];

    /**
     *
     * @var array|EnumeratorFactoryInterface[]
     */
    private static $enumeratorFactories = [];

    /**
     * 
     * @param string $name
     * @return bool
     */
    final public static function hasAggregatorFactory(string $name): bool
    {
        return isset(self::$aggregatorFactories[$name]);
    }

    /**
     * 
     * @param string $name
     * @return AggregatorFactoryInterface
     * @throws OperationException
     */
    final public static function getAggregatorFactory(string $name): AggregatorFactoryInterface
    {
        if (isset(self::$aggregatorFactories[$name])) {
            return self::$aggregatorFactories[$name];
        }

        $message = vsprintf('No AggregatorFactory registered with name "%s"', [
            $name,
        ]);
        throw new OperationException($name, $message);
    }

    /**
     * 
     * @param AggregatorFactoryInterface $aggregatorFactory
     * @return void
     */
    final public static function addAggregatorFactory(AggregatorFactoryInterface $aggregatorFactory): void
    {
        self::$aggregatorFactories[$aggregatorFactory->getName()] = $aggregatorFactory;
    }

    /**
     * 
     * @param string $name
     * @return bool
     */
    final public static function hasEnumeratorFactory(string $name): bool
    {
        return isset(self::$enumeratorFactories[$name]);
    }

    /**
     * 
     * @param string $name
     * @return EnumeratorFactoryInterface
     * @throws OperationException
     */
    final public static function getEnumeratorFactory(string $name): EnumeratorFactoryInterface
    {
        if (isset(self::$enumeratorFactories[$name])) {
            return self::$enumeratorFactories[$name];
        }

        $message = vsprintf('No EnumeratorFactory registered with name "%s"', [
            $name,
        ]);
        throw new OperationException($name, $message);
    }

    /**
     * 
     * @param AggregatorFactoryInterface $enumeratorFactory
     * @return void
     */
    final public static function addEnumeratorFactory(EnumeratorFactoryInterface $enumeratorFactory): void
    {
        self::$enumeratorFactories[$enumeratorFactory->getName()] = $enumeratorFactory;
    }

    /**
     *
     * @var CollectionInterface
     */
    private $collection;

    /**
     * 
     * @param CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    /**
     * 
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    final public function __call(string $name, array $arguments)
    {
        return $this->apply($name, ...$arguments);
    }

    /**
     * 
     * @return CollectionInterface
     */
    final public function getCollection(): CollectionInterface
    {
        return $this->collection;
    }

}
