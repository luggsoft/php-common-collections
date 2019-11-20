<?php

namespace Luggsoft\Php\Common\Collections;

interface EnumeratorFactoryInterface
{
    
    /**
     *
     * @return string
     */
    function getName(): string;
    
    /**
     *
     * @param iterable|mixed[] $arguments
     * @return EnumeratorInterface
     */
    function createEnumerator(...$arguments): EnumeratorInterface;
    
}
