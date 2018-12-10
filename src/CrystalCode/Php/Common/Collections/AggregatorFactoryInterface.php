<?php

namespace CrystalCode\Php\Common\Collections;

interface AggregatorFactoryInterface
{

    /**
     * 
     * @return string
     */
    function getName(): string;

    /**
     * 
     * @param iterable|mixed[] $arguments
     * @return AggregatorInterface
     */
    function createAggregator(...$arguments): AggregatorInterface;

}
