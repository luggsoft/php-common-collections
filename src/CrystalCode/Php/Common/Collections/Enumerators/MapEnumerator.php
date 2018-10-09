<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;

class MapEnumerator extends EnumeratorBase
{

    /**
     * 
     * @param array $segments
     * @return MapEnumerator
     */
    public static function createFromSegments(array $segments)
    {
        return new MapEnumerator(function ($value) use ($segments) {
            foreach ($segments as $segment) {
                if (is_object($value)) {
                    $value = $value->{$segment};
                    continue;
                }
                if (is_array($value)) {
                    $value = $value[$segment];
                    continue;
                }
                return null;
            }
            return $value;
        });
    }

    /**
     *
     * @var callable
     */
    private $mapper;

    /**
     * 
     * @param callable $mapper
     */
    public function __construct(callable $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection)
    {
        foreach ($collection as $key => $value) {
            yield $key => call_user_func($this->mapper, $value, $key);
        }
    }

}
