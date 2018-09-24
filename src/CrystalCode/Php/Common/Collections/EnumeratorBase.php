<?php

namespace CrystalCode\Php\Common\Collections;

abstract class EnumeratorBase implements EnumeratorInterface
{

    /**
     * 
     * @param CollectionInterface $collection
     * @return CollectionInterface
     */
    public final function enumerate(CollectionInterface $collection)
    {
        $callable = function () use ($collection) {
            foreach ($this->iterate($collection) as $key => $value) {
                yield $key => $value;
            }
        };
        return Collection::create($callable);
    }

    /**
     * 
     * @param CollectionInterface $collection
     * @return Iterator
     */
    public abstract function iterate(CollectionInterface $collection);

}
