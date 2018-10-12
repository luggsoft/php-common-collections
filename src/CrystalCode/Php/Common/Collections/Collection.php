<?php

namespace CrystalCode\Php\Common\Collections;

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
     * @param mixed $values
     * @return Collection
     */
    public static function collect(...$values): Collection
    {
        return self::create($values);
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
        return new Collection($value);
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function __construct(iterable $iterable = null)
    {
        parent::__construct($iterable ?: []);
    }

}
