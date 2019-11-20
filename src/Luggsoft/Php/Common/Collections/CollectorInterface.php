<?php

namespace Luggsoft\Php\Common\Collections;

use IteratorAggregate;

interface CollectorInterface extends IteratorAggregate
{
    
    /**
     *
     * @param string $name
     * @param iterable|mixed[] $arguments
     * @return mixed
     */
    function apply(string $name, ...$arguments);
    
    /**
     *
     * @return CollectionInterface
     */
    function getCollection(): CollectionInterface;
    
}
