<?php

namespace CrystalCode\Php\Common\Collections;

use Iterator;

abstract class CollectionBase implements CollectionInterface
{

    /**
     *
     * @var Iterator
     */
    private $iterator;

    /**
     * 
     * @param mixed $iterable
     */
    public function __construct($iterable)
    {
        $this->iterator = call_user_func(function () use ($iterable) {
            foreach ($iterable as $key => $value) {
                yield $key => $value;
            }
        });
    }

    /**
     * 
     * @param EnumeratorInterface $enumerator
     * @return CollectionInterface
     */
    public function enumerateWith(EnumeratorInterface $enumerator)
    {
        return $enumerator->enumerate($this);
    }

    /**
     * 
     * @param AggregatorInterface $aggregator
     * @return mixed
     */
    public function aggregateWith(AggregatorInterface $aggregator)
    {
        return $aggregator->aggregate($this);
    }

    /**
     * 
     * @return Iterator
     */
    public function getIterator()
    {
        return $this->iterator;
    }

    /**
     * 
     * @return array
     */
    public function toArray()
    {
        return iterator_to_array($this);
    }

}
