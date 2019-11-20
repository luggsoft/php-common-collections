<?php

namespace Luggsoft\Php\Common\Collections;

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
     * @param iterable $iterable
     */
    public function __construct(iterable $iterable)
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
    final public function enumerateWith(EnumeratorInterface $enumerator): CollectionInterface
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
    final public function toArray(): array
    {
        return iterator_to_array($this);
    }
    
}
