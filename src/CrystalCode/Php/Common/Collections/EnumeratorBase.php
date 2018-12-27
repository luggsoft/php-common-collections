<?php

namespace CrystalCode\Php\Common\Collections;

abstract class EnumeratorBase implements EnumeratorInterface
{

    /**
     * 
     * @return EnumeratorFactoryInterface
     */
    abstract static function getEnumeratorFactory(): EnumeratorFactoryInterface;

    /**
     * 
     * {@inheritdoc}
     */
    public final function enumerate(CollectionInterface $collection): CollectionInterface
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
     * @return iterable
     */
    public abstract function iterate(CollectionInterface $collection): iterable;

}
