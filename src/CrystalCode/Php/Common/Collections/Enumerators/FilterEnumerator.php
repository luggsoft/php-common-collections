<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;
use Iterator;

class FilterEnumerator extends EnumeratorBase
{

    /**
     *
     * @var callable
     */
    private $predicate;

    /**
     * 
     * @param callable $predicate
     */
    public function __construct(callable $predicate)
    {
        $this->predicate = $predicate;
    }

    /**
     * 
     * @param CollectionInterface $collection
     * @return Iterator
     */
    public function iterate(CollectionInterface $collection)
    {
        foreach ($collection as $key => $value) {
            if ((bool) call_user_func($this->predicate, $value, $key)) {
                yield $key => $value;
            }
        }
    }

}
