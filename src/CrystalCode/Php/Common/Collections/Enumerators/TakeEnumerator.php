<?php

namespace CrystalCode\Php\Common\Collections\Enumerators;

use CrystalCode\Php\Common\Collections\CollectionInterface;
use CrystalCode\Php\Common\Collections\EnumeratorBase;

class TakeEnumerator extends EnumeratorBase
{

    /**
     *
     * @var int
     */
    private $count;

    /**
     * 
     * @param int $count
     */
    public function __construct(int $count)
    {
        $this->count = $count;
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function iterate(CollectionInterface $collection): iterable
    {
        $count = $this->count;
        foreach ($collection as $key => $value) {
            if ($count -- > 0) {
                yield $key => $value;
            }
            else {
                break;
            }
        }
    }

}
