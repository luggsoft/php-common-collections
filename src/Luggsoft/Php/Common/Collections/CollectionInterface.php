<?php

namespace Luggsoft\Php\Common\Collections;

use IteratorAggregate;

interface CollectionInterface extends IteratorAggregate
{
    
    /**
     *
     * @param EnumeratorInterface $enumerator
     * @return CollectionInterface
     */
    function enumerateWith(EnumeratorInterface $enumerator): CollectionInterface;
    
    /**
     *
     * @param AggregatorInterface $aggregator
     * @return mixed
     */
    function aggregateWith(AggregatorInterface $aggregator);
    
    /**
     *
     * @return array
     */
    function toArray(): array;
    
}
