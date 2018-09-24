<?php

namespace CrystalCode\Php\Common\Collections;

interface AggregatorInterface
{

    /**
     * 
     * @param CollectionInterface $collection
     * @return mixed
     */
    function aggregate(CollectionInterface $collection);

}
