<?php

namespace CrystalCode\Php\Common\Collections;

interface CollectorInterface
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
