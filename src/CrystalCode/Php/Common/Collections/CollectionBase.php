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
     * {@inheritdoc}
     */
    final public function enumerateWith(EnumeratorInterface $enumerator)
    {
        return $enumerator->enumerate($this);
    }

    /**
     * 
     * {@inheritdoc}
     */
    final public function aggregateWith(AggregatorInterface $aggregator)
    {
        return $aggregator->aggregate($this);
    }

    /**
     * 
     * {@inheritdoc}
     */
    final public function getIterator()
    {
        return $this->iterator;
    }

    /**
     * 
     * {@inheritdoc}
     */
    final public function toArray()
    {
        return iterator_to_array($this);
    }

}
