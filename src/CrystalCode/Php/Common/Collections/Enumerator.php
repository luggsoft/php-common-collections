<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Php\Common\NotImplementedOperationException;

final class Enumerator extends EnumeratorBase
{

    /**
     * 
     * @param CollectionInterface $collection
     * @return iterable
     * @throws NotImplementedOperationException
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        throw new NotImplementedOperationException(__METHOD__);
    }

}
