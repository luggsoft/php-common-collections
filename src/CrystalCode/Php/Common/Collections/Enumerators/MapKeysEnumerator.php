<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;
use Iterator;

class MapKeysEnumerator extends EnumeratorBase
{

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
     * @param CollectionInterface $collection
     * @return Iterator
     */
    public function iterate(CollectionInterface $collection)
    {
        foreach ($collection as $key => $value) {
            yield call_user_func($this->mapper, $value, $key) => $value;
        }
    }

}
