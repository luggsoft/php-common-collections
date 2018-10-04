<?php

namespace CrystalCode\Php\Common\Collections;

interface EnumeratorInterface
{

    /**
     * 
     * @param CollectionInterface $collection
     * @return CollectionInterface
     */
    function enumerate(CollectionInterface $collection);

}
