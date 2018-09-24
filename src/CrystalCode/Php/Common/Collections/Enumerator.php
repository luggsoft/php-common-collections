<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Common\NotImplementedException;
use Iterator;

final class Enumerator extends EnumeratorBase
{

    /**
     * 
     * @param CollectionInterface $collection
     * @return Iterator
     * @throws NotImplementedException
     */
    public function iterate(CollectionInterface $collection)
    {
        throw new NotImplementedException();
    }

}
