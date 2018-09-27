<?php

namespace CrystalCode\Php\Common\Collections;

use Exception;

final class Collectizer
{

    /**
     *
     * @var array|callable[]
     */
    private static $aggregatorProviders = [];

    /**
     *
     * @var array|callable[]
     */
    private static $enumeratorProviders = [];

    /**
     * 
     * @param mixed $value
     * @return Collectizer
     */
    public static function create($value)
    {
        $collection = Collection::create($value);
        return new Collectizer($collection);
    }

    /**
     * 
     * @param string $name
     * @param callable $provider
     * @return void
     */
    public static function registerAggregator($name, callable $provider)
    {
        self::$aggregatorProviders[$name] = $provider;
    }

    /**
     * 
     * @param string $name
     * @param callable $provider
     * @return void
     */
    public static function registerEnumerator($name, callable $provider)
    {
        self::$enumeratorProviders[$name] = $provider;
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
     * @return Collectizer
     * @throws Exception
     */
    public function __call($name, array $arguments)
    {
        if (isset(Collectizer::$aggregatorProviders[$name])) {
            $aggregator = call_user_func_array(Collectizer::$enumeratorProviders[$name], $arguments);
            return $this->collection->aggregateWith($aggregator);
        }
        if (isset(Collectizer::$enumeratorProviders[$name])) {
            $enumerator = call_user_func_array(Collectizer::$enumeratorProviders[$name], $arguments);
            $collection = $this->collection->enumerateWith($enumerator);
            return new Collectizer($collection);
        }
        throw new Exception();
    }

    /**
     * 
     * @return Collection
     */
    public function toCollection()
    {
        return Collection::create(function () {
            foreach ($this->collection as $key => $value) {
                yield $key => $value;
            }
        });
    }

}
