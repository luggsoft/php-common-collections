<?php

namespace Luggsoft\Php\Common\Collections;

interface EnumeratorInterface
{
    
    /**
     *
     * @param CollectionInterface $collection
     * @return CollectionInterface
     */
    function enumerate(CollectionInterface $collection): CollectionInterface;
    
}
