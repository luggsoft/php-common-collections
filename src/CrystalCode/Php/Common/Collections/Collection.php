<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Php\Common\StringIterator;

final class Collection extends CollectionBase
{

    /**
     * 
     * @return callable
     */
    public static function getDefaultMapper(): callable
    {
        return function ($value) {
            return $value;
        };
    }

    /**
     * 
     * @return callable
     */
    public static function getDefaultKeyMapper(): callable
    {
        return function ($value, $key) {
            return $key;
        };
    }

    /**
     * 
     * @return callable
     */
    public static function getDefaultPredicate(): callable
    {
        return function ($value) {
            return empty($value) === false;
        };
    }

    /**
     * 
     * @return callable
     */
    public static function getDefaultKeyPredicate(): callable
    {
        return function ($value, $key) {
            return empty($key) === false;
        };
    }

    /**
     * 
     * @param mixed $min
     * @param mixed $max
     * @param mixed $step
     * @return Collection
     */
    public static function range($min = 0, $max = PHP_INT_MAX, $step = 1): Collection
    {
        return self::create(function () use ($min, $max, $step) {
              for ($value = $min; $value <= $max; $value = $value + $step) {
                  yield $value;
              }
          });
    }

    /**
     * 
     * @param mixed $value
     * @return Collection
     */
    public static function create($value = null): Collection
    {
        if (is_callable($value)) {
            $iterable = call_user_func($value);
            return new Collection($iterable);
        }
        if (is_string($value)) {
            $iterable = new StringIterator($value);
            return new Collection($iterable);
        }
        return new Collection($value);
    }

    /**
     * 
     * @param iterable $iterable
     */
    public function __construct(iterable $iterable = null)
    {
        parent::__construct($iterable ?: []);
    }

}
