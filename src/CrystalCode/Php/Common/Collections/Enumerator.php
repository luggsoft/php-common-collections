<?php

namespace CrystalCode\Php\Common\Collections;

use CrystalCode\Php\Common\NotImplementedException;

final class Enumerator extends EnumeratorBase
{

    /**
     * 
     * @param CollectionInterface $collection
     * @return iterable
     * @throws NotImplementedException
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        throw new NotImplementedException();
    }

}
