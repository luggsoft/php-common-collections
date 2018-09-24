<?php

namespace CrystalCode\Php\Common\Collections;

class Collection extends CollectionBase
{

    /**
     * 
     * @param mixed $values
     * @return Collection
     */
    public static function collect(...$values)
    {
        return self::create($values);
    }

    /**
     * 
     * @param mixed $value
     * @return Collection
     */
    public static function create($value = null)
    {
        if (is_callable($value)) {
            $iterable = call_user_func($value);
            return new Collection($iterable);
        }
        return new Collection($value);
    }

    /**
     * 
     * @param mixed $iterable
     */
    public function __construct($iterable = null)
    {
        parent::__construct($iterable ?: []);
    }

}
