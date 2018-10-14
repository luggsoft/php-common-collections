<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;

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
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        foreach ($collection as $key => $value) {
            if ((bool) call_user_func($this->predicate, $value, $key)) {
                yield $key => $value;
            }
        }
    }

}
