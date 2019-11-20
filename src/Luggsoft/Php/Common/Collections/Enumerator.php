<?php

namespace Luggsoft\Php\Common\Collections;

use Luggsoft\Php\Common\NotImplementedOperationException;

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
