<?php

namespace CrystalCode\Php\Common\Collections;

abstract class AggregatorBase implements AggregatorInterface
{

    /**
     * 
     * @return callable
     */
    public final static function getDefaultKeySelector()
    {
        return function ($item, $key) {
            return $key;
        };
    }

    /**
     * 
     * @return callable
     */
    public final static function getDefaultValueMapper()
    {
        return function ($item) {
            return $item;
        };
    }

    /**
     *
     * @var mixed
     */
    private $initial;

    /**
     *
     * @var callable
     */
    private $applicator;

    /**
     * 
     * @param callable $applicator
     * @param mixed $initial
     */
    function __construct(callable $applicator, $initial = null)
    {
        $this->applicator = $applicator;
        $this->initial = $initial;
    }

    /**
     * 
     * @param CollectionInterface $collection
     * @return mixed
     */
    public function aggregate(CollectionInterface $collection)
    {
        $result = $this->initial;
        foreach ($collection as $key => $item) {
            $result = call_user_func($this->applicator, $result, $item, $key);
        }
        return $result;
    }

}
